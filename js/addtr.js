function addNewRow() {
        var tbl = document.getElementById("lineItemTable");
        var row = tbl.insertRow(tbl.rows.length);
        var td0 = document.createElement("td");
        var td1 = document.createElement("td");
        var td2 = document.createElement("td");
        var td3 = document.createElement("td");
        var td4 = document.createElement("td");
        var td5 = document.createElement("td");
        var td6 = document.createElement("td");
        var td7 = document.createElement("td");
        var td8 = document.createElement("td");
        
        td0.appendChild(generateIndex(row.rowIndex));
        td1.appendChild(generateKoor1(row.rowIndex));
        td2.appendChild(generateKoor2(row.rowIndex));
        td3.appendChild(generateKoor3(row.rowIndex));
        td4.appendChild(generateKoor4(row.rowIndex));
        td5.appendChild(generateKoor5(row.rowIndex));
        td6.appendChild(generateKoor6(row.rowIndex));
        td7.appendChild(generateKoor7(row.rowIndex));
        td8.appendChild(generateKoor8(row.rowIndex));
        row.appendChild(td0);
        row.appendChild(td1);
        row.appendChild(td2);
        row.appendChild(td3);
        row.appendChild(td4);
        row.appendChild(td5);
        row.appendChild(td6);
        row.appendChild(td7);
        row.appendChild(td8);
        }
        
        function generateIndex(index) {
        var idx = document.createElement("input");
        idx.type = "hidden";
        idx.name = "index[ ]";
        idx.id = "index["+index+"]";
        idx.value = index;
        return idx;
        }
        function generateKoor1(index) {
        var idx = document.createElement("input");
        idx.type = "text";
        idx.name = "check[ ]";
        idx.id = "check["+index+"]";
        idx.size = "2";
        return idx;
        }
        function generateKoor2(index) {
        var idx = document.createElement("input");
        idx.type = "text";
        idx.name = "nomorInduk[ ]";
        idx.id = "nomorInduk["+index+"]";
        idx.size = "2";
        return idx;
        }
        function generateKoor3(index) {
        var idx = document.createElement("input");
        idx.type = "text";
        idx.name = "nomorRegister[ ]";
        idx.id = "nomorRegister["+index+"]";
        idx.size = "2";
        return idx;
        }
        function generateKoor4(index) {
        var idx = document.createElement("input");
        idx.type = "text";
        idx.name = "namaSiswa[ ]";
        idx.id = "namaSiswa["+index+"]";
        idx.size = "2";
        return idx;
        }
        function generateKoor5(index) {
        var idx = document.createElement("input");
        idx.type = "text";
        idx.name = "alamatSiswa[ ]";
        idx.id = "alamatSiswa["+index+"]";
        idx.size = "2";
        return idx;
        }
        function generateKoor6(index) {
        var idx = document.createElement("input");
        idx.type = "text";
        idx.name = "alamatSiswa[ ]";
        idx.id = "alamatSiswa["+index+"]";
        idx.size = "2";
        return idx;
        }
        function generateKoor7(index) {
        var idx = document.createElement("input");
        idx.type = "text";
        idx.name = "alamatSiswa2[ ]";
        idx.id = "alamatSiswa2["+index+"]";
        idx.size = "2";
        return idx;
        }
        function generateKoor8(index) {
        var idx = document.createElement("input");
        idx.type = "text";
        idx.name = "alamatSiswa3[ ]";
        idx.id = "alamatSiswa3["+index+"]";
        idx.size = "2";
        return idx;
        }
        
        
        
        
function clickAll() {
        var checked = false;
        if (document.getElementById("checkMaster").checked == true)
        checked = true;
        var tbl = document.getElementById("lineItemTable");
        var rowLen = tbl.rows.length;
        for (var idx=1;idx<rowLen;idx++) {
        var row = tbl.rows[idx];
        var cell = row.cells[1];
        var node = cell.lastChild;
        node.checked = checked;
        }
        }
        function deleteAll() {
        var tbl = document.getElementById("lineItemTable");
        var rowLen = tbl.rows.length - 1;
        for (var idx=rowLen;idx > 0;idx--) {
        tbl.deleteRow(idx)
        }
        }
        function bufferRow(table) {
        var tbl = document.getElementById("lineItemTable");
        var rowLen = tbl.rows.length;
        for (var idx=1;idx<rowLen;idx++) {
        var row = tbl.rows[idx];
        var cell = row.cells[1];
        var node = cell.lastChild;
        if (node.checked == false) {
        var rowNew = table.insertRow(table.rows.length);
        var td0 = document.createElement("td");
        var td1 = document.createElement("td");
        var td2 = document.createElement("td");
        var td3 = document.createElement("td");
        var td4 = document.createElement("td");
        td0.appendChild(row.cells[0].lastChild);
        td1.appendChild(row.cells[1].lastChild);
        td2.appendChild(row.cells[2].lastChild);
        td3.appendChild(row.cells[3].firstChild);
        td3.appendChild(row.cells[3].lastChild);
        td4.appendChild(row.cells[4].lastChild);
        rowNew.appendChild(td0);
        rowNew.appendChild(td1);
        rowNew.appendChild(td2);
        rowNew.appendChild(td3);
        rowNew.appendChild(td4);
        }
        }
        }
        function reIndex(table) {
        var tbl = document.getElementById("lineItemTable");
        var rowLen = table.rows.length;
        for (var idx=0;idx < rowLen;idx++) {
        var row = table.rows[idx];
        var rowTbl = tbl.insertRow(tbl.rows.length);
        var td0 = document.createElement("td");
        var td1 = document.createElement("td");
        var td2 = document.createElement("td");
        var td3 = document.createElement("td");
        var td4 = document.createElement("td");
        td0.appendChild(row.cells[0].lastChild);
        td1.appendChild(row.cells[1].lastChild);
        td2.appendChild(row.cells[2].lastChild);
        td3.appendChild(row.cells[3].firstChild);
        td3.appendChild(row.cells[3].lastChild);
        td4.appendChild(row.cells[4].lastChild);
        rowTbl.appendChild(td0);
        rowTbl.appendChild(td1);
        rowTbl.appendChild(td2);
        rowTbl.appendChild(td3);
        rowTbl.appendChild(td4);
        }
        }
        function deleteRow() {
        var tbl = document.getElementById("lineItemTable");
        var error = false;
        if (document.getElementById("checkMaster").checked == false)
        error = true;
        var tbl = document.getElementById("lineItemTable");
        var rowLen = tbl.rows.length;
        for (var idx=1;idx<rowLen;idx++) {
        var row = tbl.rows[idx];
        var cell = row.cells[1];
        var node = cell.lastChild;
        if (node.checked == true) {
        error = false;
        break;
        }
        }
        if (error == true) {
        alert ("Checkbox tidak di cek, proses tidak dapat dilanjutkan");
        return;
        }
        if (document.getElementById("checkMaster").checked == true) {
        deleteAll();
        document.getElementById("checkMaster").checked = false;
        } else {
        var table = document.createElement("table");
        bufferRow(table);
        deleteAll();
        reIndex(table);
        }
        }
        
        
        
        
        
function addNewRow2() {
        var tbl = document.getElementById("lineItemTable2");
        var row = tbl.insertRow(tbl.rows.length);
        var td10 = document.createElement("td");
        var td11 = document.createElement("td");
        var td12 = document.createElement("td");
        
        td10.appendChild(generateIndex1(row.rowIndex));
        td11.appendChild(generateKoor11(row.rowIndex));
        td12.appendChild(generateKoor12(row.rowIndex));
        row.appendChild(td10);
        row.appendChild(td11);
        row.appendChild(td12);
        }
        
        function generateIndex1(index) {
        //var idx1 = document.createElement("div");
        var mydiv=document.createElement("div");
        ///index=index=-1;
        var c=index;
        //c=c-1;
        var divtext=document.createTextNode(c);
        mydiv.appendChild(divtext);
        //idx1.type = "text";
        //idx1.name = "index[ ]";
        //idx1.id = "index["+index+"]";
        //idx1.value = index;
        //return idx1;
        return mydiv;
        }
        function generateKoor11(index) {
        var idx2 = document.createElement("input");
        idx2.type = "radio";
        idx2.name = "check[ ]";
        idx2.id = "check["+index+"]";
        idx2.size = "2";
        return idx2;
        }
        function generateKoor12(index) {
        var idx3 = document.createElement("input");
        idx3.type = "file";
        idx3.name = "nomorInduk[ ]";
        idx3.id = "nomorInduk["+index+"]";
        idx3.size = "20";
        return idx3;
        }
