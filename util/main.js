import fs from 'fs';

const csvData = [
  ['Name', 'Age', 'Email'],
  ['John Doe', '30', 'john@example.com'],
  ['Jane Smith', '25', 'jane@example.com'],
];

const csvContent = csvData.map((row) => row.join(',')).join('\n');

fs.writeFile('output.csv', csvContent, (error) => {
  if (error) {
    console.error('CSVファイルの作成中にエラーが発生しました:', error);
  } else {
    console.log('CSVファイルが作成されました。');
  }
});