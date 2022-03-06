<div class="jumbotron">
    <h1 style="font-weight:600;">Filtro de biopsias prostáticas</h1>

    <hr class="my-4">

    <div class="form-row align-items-center">
        <div class="col-xl-">
            <h3> Gleason 1 </h3>
        </div>
        <div class="col my-auto">
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" style="width:10em">
                <option selected>Choose...</option>
                <option value="1">6</option>
                <option value="2">7 (3+4)</option>
                <option value="3">7 (4+3)</option>
                <option value="4">8-10</option>
                <option value="5">Inclasificable</option>
            </select>
        </div>
    </div>

    <hr class="my-4">

    <div class="form-row align-items-center">
        <div class="col-xl-">
            <h3> Número de cilindros positivos </h3>
        </div>
        <div class="col my-auto">
            <input type="range" value="50" min="0" max="100" oninput="this.nextElementSibling.value = this.value">
            <output style="margin-left:10px">50</output>%
        </div>
    </div>

    <hr class="my-4">

    <div class="form-row align-items-center">
        <div class="col-xl-">
            <h3> Mayor % afectación un cilindro </h3>
        </div>
        <div class="col my-auto">
            <input type="range" value="50" min="0" style="width:80%; margin-left:10px" max="100" step="1" oninput="this.nextElementSibling.value = this.value">
        <output style="margin-left:10px">50</output>%                    
        </div>
        <div class="col my-auto">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="portcilop1" onclick="toggleCB(document.getElementById('portcilop3'))">
                <label class="custom-control-label" for="portcilop1">Menor que</label>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="portcilop2">
                <label class="custom-control-label" for="portcilop2">Igual</label>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="portcilop3" onclick="toggleCB(document.getElementById('portcilop1'))">
                <label class="custom-control-label" for="portcilop3">Mayor que</label>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <div class="form-row align-items-center">
        <div class="col-xl-">
            <h3> cTNM biopsia </h3>
        </div>
        <div class="col my-auto">
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" style="width:10em">
                <option selected>Choose...</option>
                <option value="1">cT2ab</option>
                <option value="2">cT2c</option>
                <option value="3">cT3</option>
            </select>
        </div>
    </div>
</div>
