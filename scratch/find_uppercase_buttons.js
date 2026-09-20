const fs = require('fs');
const path = require('path');

function walkDir(dir, callback) {
  fs.readdirSync(dir).forEach(f => {
    let dirPath = path.join(dir, f);
    let isDirectory = fs.statSync(dirPath).isDirectory();
    if (isDirectory) {
      if (f !== 'node_modules' && f !== '.astro' && f !== '.vercel' && f !== '.git') {
        walkDir(dirPath, callback);
      }
    } else {
      callback(dirPath);
    }
  });
}

const srcDir = path.join(__dirname, '..', 'src');
const results = [];

walkDir(srcDir, (filePath) => {
  if (!filePath.endsWith('.astro')) return;
  const content = fs.readFileSync(filePath, 'utf8');
  const lines = content.split('\n');
  
  lines.forEach((line, index) => {
    // Check if the line has "uppercase" and is a button, an anchor, or has button-like classes
    if (line.includes('uppercase')) {
      const isButtonOrLink = line.match(/<button|<a\b/) || 
                             line.includes('px-') || 
                             line.includes('py-') || 
                             line.includes('rounded-full') || 
                             line.includes('cursor-pointer') ||
                             line.includes('tab-btn');
                             
      if (isButtonOrLink) {
        results.push({
          file: path.relative(path.join(__dirname, '..'), filePath),
          lineNum: index + 1,
          content: line.trim()
        });
      }
    }
  });
});

console.log(JSON.stringify(results, null, 2));
