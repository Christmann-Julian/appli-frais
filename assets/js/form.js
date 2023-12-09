document.getElementById("formAdd").addEventListener("change", function(){
    ffnuiteQte = document.getElementById("ffnuiteQte").value;
    ffnuiteM = document.getElementById("ffnuiteM").value;
    ffnuiteTot = document.getElementById("ffnuiteTot");
    ffnuiteTot.value = ffnuiteM * ffnuiteQte;

    ffrepasQte = document.getElementById("ffrepasQte").value;
    ffrepasM = document.getElementById("ffrepasM").value;
    ffrepasTot = document.getElementById("ffrepasTot");
    ffrepasTot.value = ffrepasM * ffrepasQte;

    ffkiloQte = document.getElementById("ffkiloQte").value;
    ffkiloM = document.getElementById("ffkiloM").value;
    ffkiloTot = document.getElementById("ffkiloTot");
    ffkiloTot.value = ffkiloM * ffkiloQte;
});