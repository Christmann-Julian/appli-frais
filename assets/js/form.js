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

let formcount = 0;

function addHf() {
    if(formcount<10){
        formcount++;

        const addHF = document.createElement('div');
        addHF.className = 'row';
    
        addHF.innerHTML = `
            <div class="col-md-4 col-sm-12 mb-3">
                <label for="fhdate${formcount}" class="form-label">Date</label>
                <input name="fhdate${formcount}" id="fhdate${formcount}" class="form-control" type="date" required>
            </div>
            <div class="col-md-4 col-sm-12 mb-3">
                <label for="fhlib${formcount}" class="form-label">Libellé</label>
                <input name="fhlib${formcount}" type="text" class="form-control" id="fhlib${formcount}" required>
            </div>
            <div class="col-md-4 col-sm-12 mb-3">
                <label for="fhM${formcount}" class="form-label">Montant</label>
                <div class="input-group">
                    <input name="fhM${formcount}" type="number" class="form-control" id="fhM${formcount}" min="0" step="0.01" required>
                    <span class="input-group-text">€</span>
                </div>
            </div>
        `;
    
        document.getElementById('containerHF').appendChild(addHF);
    }else{
        alert("Vous ne pouvez pas avoir plus de 10 frais hors forfait.");
    }
}

function deleteHf() {
    if (formcount > 0) {
        const lastRow = document.getElementById('containerHF').lastChild;
        document.getElementById('containerHF').removeChild(lastRow);
        formcount--;
    } else {
        alert("Aucune ligne hors forfait existe.");
    }
}