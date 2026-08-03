<div>
    <div id="vk-error-message" style="color:red;display:none;margin-bottom:10px;padding:10px;border:1px solid red;border-radius:4px;"></div>
    <div>
        <script nonce="csp_nonce" src="https://unpkg.com/@vkid/sdk@<3.0.0/dist-sdk/umd/index.js"></script>
        <script nonce="csp_nonce" type="text/javascript">
            if ('VKIDSDK' in window) {
                const VKID = window.VKIDSDK;

                VKID.Config.init({
                    app: {{config('services.vk.client_id')}},
                    redirectUrl: '{{config('app.url')}}' + '/auth/vk/callback',
                    responseMode: VKID.ConfigResponseMode.Callback,
                    source: VKID.ConfigSource.LOWCODE,
                    scope: 'vkid.personal_info email phone',
                });

                const oneTap = new VKID.OneTap();

                oneTap.render({
                    container: document.currentScript.parentElement,
                    showAlternativeLogin: true
                })
                    .on(VKID.WidgetEvents.ERROR, vkidOnError)
                    .on(VKID.OneTapInternalEvents.LOGIN_SUCCESS, function (payload) {
                        const code = payload.code;
                        const deviceId = payload.device_id;

                        VKID.Auth.exchangeCode(code, deviceId)
                            .then(vkidOnSuccess)
                            .catch(vkidOnError);
                    });

                function showError(message) {
                    const errorDiv = document.getElementById('vk-error-message');
                    if (errorDiv) {
                        errorDiv.textContent = message;
                        errorDiv.style.display = 'block';
                        setTimeout(() => {
                            errorDiv.style.display = 'none';
                        }, 5000);
                    }
                }

                function vkidOnSuccess(data) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                    fetch("{{ route('vk.callback') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken || ''
                        },
                        body: JSON.stringify(data)
                    })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(err => {
                                    throw new Error(err.error || err.message || 'Ошибка сервера');
                                });
                            }
                            return response.json();
                        })
                        .then(result => {
                            if (result.success) {
                                window.location.href = result.redirect;
                            } else if (result.error === 'user_not_found') {
                                if (result.vk_data) {
                                    sessionStorage.setItem('vk_registration_data', JSON.stringify(result.vk_data));
                                }
                                window.location.href = "{{ route('register') }}?vk=1";
                            } else {
                                showError(result.message || result.error || 'Неизвестная ошибка');
                            }
                        })
                        .catch(error => {
                            showError(error.message || 'Ошибка соединения с сервером');
                        });
                }

                function vkidOnError(error) {
                    // Игнорируем timeout
                    if (error && error.code === 0 && error.text === 'timeout') {
                        console.log('VK ID timeout - игнорируем');
                        return;
                    }

                    showError('Ошибка VK ID: ' + (error.message || error.text || 'Неизвестная ошибка'));
                }
            } else {
                const errorDiv = document.getElementById('vk-error-message');
                if (errorDiv) {
                    errorDiv.textContent = 'Ошибка загрузки VK ID SDK';
                    errorDiv.style.display = 'block';
                }
            }
        </script>
    </div>
</div>
