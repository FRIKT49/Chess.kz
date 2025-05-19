function kingIsBehind(aH, color) {
    const kingCell = $(".cell_black_king_1");
    const kingCellId = kingCell.attr("id");
    aH.forEach(function (arr) {
        console.log(arr);
        arr[0].forEach(function (id) {
            // console.log(kingCellId[2],kingCellId[3],id[2],id[3]);



            // console.log(id[2] , kingCellId[2] , id[3] , kingCellId[3]);

            if (id[2] == kingCellId[2] && id[3] == kingCellId[3] && arr[1] != color) {
                console.log('kingIsUnderAttack');
                arr[0].forEach(function (ida) {

                    
                    
                    const cell = $('.cell' + ida[2] + ida[3])
                    const cellClass = cell.attr("class");
                    
                    
                    console.log(cellClass);
                    if (cellClass) {
                        if (isCellOccupied(ida[2], ida[3]) && cellClass.includes(color)) {
                            console.log(cellClass);
                            let cellClassSplit = cellClass.split(" ");
                            let cellClassColor = cellClassSplit[0].split("_")[0];
                            let cellClassFigure = cellClassSplit[0].split("_")[1];
                            let cellClassI = cellClassSplit[0].split("_")[2];
                            cell.attr("class", cellClassColor + '_' + cellClassFigure + '_' + cellClassI+' ' + 'figure ' + cellClassSplit[2] + ' ' + 'cantMove')

                        }
                    }
                })
            }
        })
    })
}
