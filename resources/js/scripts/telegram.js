// Telegram Integration for Saratov 435
// Sends form submissions to Telegram bot

const TelegramIntegration = {
    // Bot configuration (your original bot)
    BOT_TOKEN: '8413702074:AAGkb5dXD1HRLCM9QD_D1ib6PwwrCXLxjv8',
    CHAT_ID: -1003075044694, // Your Telegram group chat ID
    GROUP_INVITE_LINK: 'https://t.me/+3P1bCVrv5pA3ZjVi',
    
    // Get chat ID from group invite link
    async getChatId() {
        if (this.CHAT_ID) return this.CHAT_ID;
        
        try {
            console.log('Trying to get chat ID...');
            // Try to get updates to find the chat ID
            const url = `https://api.telegram.org/bot${this.BOT_TOKEN}/getUpdates`;
            const response = await fetch(url);
            const data = await response.json();
            
            console.log('Telegram API response:', data);
            
            if (data.ok && data.result.length > 0) {
                // Find the group chat ID
                const groupChat = data.result.find(update => 
                    update.message && 
                    update.message.chat && 
                    (update.message.chat.type === 'group' || update.message.chat.type === 'supergroup')
                );
                
                if (groupChat) {
                    this.CHAT_ID = groupChat.message.chat.id;
                    console.log('Chat ID found:', this.CHAT_ID);
                    return this.CHAT_ID;
                }
            }
            
            console.warn('Chat ID not found. Please add @Saratov_435_bot to group and send a message.');
            return null;
        } catch (error) {
            console.error('Error getting chat ID:', error);
            return null;
        }
    },

    // Send message to Telegram (simplified like in PHP)
    async sendToTelegram(message) {
        const url = `https://api.telegram.org/bot${this.BOT_TOKEN}/sendMessage`;
        
        try {
            console.log('Sending message to Telegram...');
            console.log('Chat ID:', this.CHAT_ID);
            console.log('Message:', message);
            
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    chat_id: this.CHAT_ID,
                    text: message,
                    parse_mode: 'HTML'
                })
            });
            
            const result = await response.json();
            console.log('Telegram API response:', result);
            
            if (response.ok && result.ok) {
                console.log('✅ Message sent successfully to Telegram');
                return { success: true };
            } else {
                console.error('❌ Telegram API error:', result);
                return { 
                    success: false, 
                    error: result.description || 'API error' 
                };
            }
        } catch (error) {
            console.error('❌ Error sending to Telegram:', error);
            return { 
                success: false, 
                error: error.message 
            };
        }
    },
    
    // Format business registration for Telegram (like in PHP)
    formatBusinessRegistration(data) {
        const businessTypeMap = {
            'restaurant': 'Ресторан/Кафе',
            'hotel': 'Отель/Хостел', 
            'shop': 'Магазин',
            'entertainment': 'Развлечения',
            'museum': 'Музей/Галерея',
            'other': 'Другое'
        };
        
        return `Новая заявка на партнерство с сайта:

Компания: <b>${data.company_name || 'Не указано'}</b>
Контактное лицо: <b>${data.contact_person || 'Не указано'}</b>
Email: <b>${data.email || 'Не указано'}</b>
Телефон: <b>${data.phone || 'Не указано'}</b>
Тип бизнеса: <b>${businessTypeMap[data.business_type] || data.business_type || 'Не указано'}</b>
Описание: <b>${data.description || 'Не указано'}</b>

Время: ${new Date().toLocaleString('ru-RU')}`;
    },
    
    // Format user feedback for Telegram
    formatUserFeedback(data) {
        return `
💬 <b>Обратная связь от пользователя</b>

👤 <b>Имя:</b> ${data.name}
📧 <b>Email:</b> ${data.email}
💭 <b>Сообщение:</b> ${data.message}

⏰ <b>Время:</b> ${new Date().toLocaleString('ru-RU')}
🌐 <b>Источник:</b> saratov-435.ru

#обратная_связь #пользователь`;
    },
    
    // Format quest completion for Telegram
    formatQuestCompletion(data) {
        return `
🏆 <b>Квест завершен!</b>

👤 <b>Пользователь:</b> ${data.user}
🎯 <b>Квест:</b> ${data.quest_name}
⏱️ <b>Время прохождения:</b> ${data.duration}
🏅 <b>Награда:</b> ${data.reward}
📍 <b>Пройденные точки:</b> ${data.points}

⏰ <b>Время:</b> ${new Date().toLocaleString('ru-RU')}

#квест_завершен #достижение`;
    },
    
    // Format coupon usage for Telegram
    formatCouponUsage(data) {
        return `
🎫 <b>Использован купон</b>

🏪 <b>Партнер:</b> ${data.partner}
🎁 <b>Предложение:</b> ${data.offer}
💳 <b>Код купона:</b> ${data.code}
👤 <b>Пользователь ID:</b> ${data.user_id}

⏰ <b>Время:</b> ${new Date().toLocaleString('ru-RU')}

#купон_использован #скидка`;
    },
    
    // Send business registration
    async sendBusinessRegistration(formData) {
        try {
            const data = {
                company_name: formData.get('company_name') || formData.get('companyName'),
                email: formData.get('email'),
                phone: formData.get('phone'),
                business_type: formData.get('business_type') || formData.get('businessType'),
                description: formData.get('description'),
                contact_person: formData.get('contact_person') || formData.get('contactPerson')
            };
            
            console.log('Sending business registration data:', data);
            
            const message = this.formatBusinessRegistration(data);
            console.log('Formatted message:', message);
            
            const result = await this.sendToTelegram(message);
            console.log('Telegram send result:', result);
            
            if (result.success) {
                showNotification('Заявка успешно отправлена в Telegram!', 'success');
            } else {
                console.error('Failed to send to Telegram:', result.error);
                showNotification(`Ошибка отправки в Telegram: ${result.error}`, 'error');
            }
            
            return result;
        } catch (error) {
            console.error('Error in sendBusinessRegistration:', error);
            showNotification(`Ошибка: ${error.message}`, 'error');
            return { success: false, error: error.message };
        }
    },
    
    // Send user feedback
    async sendUserFeedback(name, email, message) {
        const data = { name, email, message };
        const formattedMessage = this.formatUserFeedback(data);
        const result = await this.sendToTelegram(formattedMessage);
        
        if (result.success) {
            window.saratovApp?.showNotification('Сообщение отправлено!', 'success');
        }
        
        return result;
    },
    
    // Send quest completion notification
    async sendQuestCompletion(questData) {
        const message = this.formatQuestCompletion(questData);
        return await this.sendToTelegram(message);
    },
    
    // Send coupon usage notification
    async sendCouponUsage(couponData) {
        const message = this.formatCouponUsage(couponData);
        return await this.sendToTelegram(message);
    }
};

// Override the business registration submission
function submitBusinessRegistration(event) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    
    // Send to Telegram
    TelegramIntegration.sendBusinessRegistration(formData);
    
    // Save to database (existing functionality)
    saveBusinessRegistration(form);
    
    // Close modal
    form.closest('.fixed').remove();
}

// Add feedback form to footer
function addFeedbackForm() {
    const feedbackHtml = `
        <div class="mt-8 bg-gray-800 rounded-lg p-6">
            <h4 class="text-white font-semibold mb-4">Связаться с нами</h4>
            <form onsubmit="sendFeedback(event)" class="space-y-3">
                <input type="text" name="name" required placeholder="Ваше имя" 
                       class="w-full px-3 py-2 rounded bg-gray-700 text-white placeholder-gray-400">
                <input type="email" name="email" required placeholder="Email" 
                       class="w-full px-3 py-2 rounded bg-gray-700 text-white placeholder-gray-400">
                <textarea name="message" required placeholder="Сообщение" rows="3"
                          class="w-full px-3 py-2 rounded bg-gray-700 text-white placeholder-gray-400"></textarea>
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
                    Отправить
                </button>
            </form>
        </div>
    `;
    
    const footer = document.querySelector('footer .grid > div:first-child');
    if (footer) {
        footer.insertAdjacentHTML('beforeend', feedbackHtml);
    }
}

// Handle feedback form submission
function sendFeedback(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    
    TelegramIntegration.sendUserFeedback(
        formData.get('name'),
        formData.get('email'),
        formData.get('message')
    );
    
    form.reset();
}

// Notification function
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-22 right-4 z-50 px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
    
    // Set colors based on type
    switch(type) {
        case 'success':
            notification.classList.add('bg-green-500', 'text-white');
            break;
        case 'error':
            notification.classList.add('bg-red-500', 'text-white');
            break;
        case 'warning':
            notification.classList.add('bg-yellow-500', 'text-white');
            break;
        default:
            notification.classList.add('bg-blue-500', 'text-white');
    }
    
    notification.innerHTML = `
        <div class="flex items-center space-x-2">
            <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : type === 'warning' ? 'exclamation' : 'info'}-circle"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 900);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            notification.remove();
        }, 900);
    }, 9000);
}

// Test bot connection function
async function testBotConnection() {
    try {
        console.log('Testing bot connection...');
        console.log('Bot Token:', TelegramIntegration.BOT_TOKEN);
        console.log('Chat ID:', TelegramIntegration.CHAT_ID);
        
        // Test with a simple message
        const testMessage = 'Тест подключения бота - ' + new Date().toLocaleString('ru-RU');
        const result = await TelegramIntegration.sendToTelegram(testMessage);
        
        if (result.success) {
            console.log('✅ Bot connection successful!');
            showNotification('Telegram бот работает!', 'success');
            return true;
        } else {
            console.error('❌ Bot connection failed:', result.error);
            showNotification(`Ошибка: ${result.error}`, 'error');
            return false;
        }
    } catch (error) {
        console.error('Error testing bot connection:', error);
        showNotification('Ошибка подключения к боту', 'error');
        return false;
    }
}

// Function to manually set chat ID
function setChatId(chatId) {
    TelegramIntegration.CHAT_ID = chatId;
    console.log('Chat ID set manually:', chatId);
    showNotification('Chat ID установлен вручную!', 'success');
}

// Initialize Telegram integration
document.addEventListener('DOMContentLoaded', () => {
    addFeedbackForm();
    
    // Test bot connection on load
    testBotConnection();
    
    // Test button removed per user request
    
    console.log('Telegram integration initialized with your working configuration!');
});

// Export for global use
window.TelegramIntegration = TelegramIntegration;
window.setChatId = setChatId;
window.testBotConnection = testBotConnection;