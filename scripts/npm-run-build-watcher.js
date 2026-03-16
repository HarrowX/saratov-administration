#!/usr/bin/env node

import { watch } from 'chokidar';
import { spawn } from 'child_process';

const gracefulStop = (watcher) => {
  console.log('\nShutting down watcher...');
  watcher.close().then(() => {
    console.log('Watcher stopped.');
    process.exit(0);
  });
};

process.on('SIGINT', () => gracefulStop(watcher));
process.on('SIGTERM', () => gracefulStop(watcher));

// Get directories from command line arguments
const directories = process.argv.slice(2);
if (directories.length === 0) {
  console.error('Please specify directories to watch:\n  node watch-dirs.js src resources/views');
  process.exit(1);
}

console.log('Watching directories:', directories.join(', '));
console.log('Command to run on change: npm run build\n');

let isBuilding = false;
let buildProcess = null;

const watcher = watch(directories, {
  ignored: [
    '**/node_modules/**',
    '**/dist/**', 
    '**/build/**',
    '**/.git/**',
    '**/.*', // dotfiles
    (path) => path.includes('node_modules') || path.includes('dist')
  ],
  persistent: true,
  ignoreInitial: true,
  awaitWriteFinish: {
    stabilityThreshold: 300,
    pollInterval: 100
  },
  cwd: process.cwd()
});

function runBuild() {
  if (isBuilding) {
    console.log('Build already in progress, skipping...');
    return;
  }
  
  isBuilding = true;
  console.log('Starting build...');
  
  buildProcess = spawn('npm', ['run', 'build'], { 
    stdio: 'inherit',
    shell: true 
  });

  buildProcess.on('close', (code) => {
    console.log(`Build completed with code ${code}`);
    isBuilding = false;
    buildProcess = null;
  });

  buildProcess.on('error', (error) => {
    console.error('Build failed:', error.message);
    isBuilding = false;
    buildProcess = null;
  });
}

// Watch events
watcher
  .on('add', (filePath) => {
    console.log(`New file: ${filePath}`);
    runBuild();
  })
  .on('change', (filePath) => {
    console.log(`Changed: ${filePath}`);
    runBuild();
  })
  .on('unlink', (filePath) => {
    console.log(`Deleted: ${filePath}`);
    runBuild();
  })
  .on('ready', () => {
    console.log('Watcher ready! Press Ctrl+C to stop.\n');
  })
  .on('error', (error) => {
    console.error('Watcher error:', error);
  });
