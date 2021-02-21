const data = require('./data.json');

const judul = data[0][0][0];
const max_rows = data[0].length;
console.log(judul);

let col = 0;
let tmp = [];
let result = [];
for (let i = 151; i < max_rows; i++) {
    const currentRow = data[0][i];
    const produsen = currentRow[7];
    const currentCell  = currentRow[col];
    if (produsen !== null) {
        if (!currentCell) {
            for (let j = col-1; j >= 0; j--) {
                if (currentRow[j] !== null) {
                    tmp[j] = currentRow[j];
                    col = j + 1;
                    break;
                } else {
                    tmp.pop();
                }
            }
        }
        let build = [];
        for (let j = 0; j < 5; j++) {
            build[j] = tmp [j] ? tmp[j] : null;
        }
        build[col] = currentRow[col];
        build[5] = currentRow[5];
        build[6] = currentRow[6] || 0;
        build[7] = currentRow[7];

        result.push(build);
    } else {
        console.log(currentRow.join('|'));
        if (currentCell) {
            tmp.push(currentCell);
            col++;
        } else {
            for (let j = col-1; j >= 0; j--) {
                if (currentRow[j] !== null) {
                    tmp[j] = currentRow[j];
                    col = j + 1;
                    break;
                } else {
                    tmp.pop();
                }
            }
        }
    }
}
console.log(result);
