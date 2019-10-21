<div id="asset" class="modal border-radius-6">
    <div class="modal-content">
        <h5 class="mt-0">Add new asset</h5>
        <hr>
        <div class="row">
            <form class="col s12">
                <div class="row">
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">exposure</i>
                        <input id="first_name" type="text" class="validate">
                        <label for="first_name">Asset Number</label>
                    </div>

                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix"> border_color </i>
                        <input id="notes" type="text" class="validate">
                        <label for="notes">Asset Description</label>
                    </div>
                    
                    <div class="input-field col col m6 s12">
                        <select>
                        <option value="" disabled selected>Choose Parent Asset Number</option>
                        <option value="1">Sample Point</option>
                        <option value="2">Heat Exchanger</option>
                    </select>
                        <label>Parent Asset Number</label>
                    </div>

                    <div class="input-field col col m6 s12">
                        <select>
                        <option value="" disabled selected>Choose component type</option>
                        <option value="1">Sample Point</option>
                        <option value="2">Heat Exchanger</option>
                    </select>
                        <label>Component Type</label>
                    </div>

                    <div class="input-field col col m6 s12">
                        <select>
                        <option value="" disabled selected>Choose Loop</option>
                        <option value="1">1PK-1101 / 1E-1106</option>
                        <option value="2">V-1102 / 1PK-1103</option>
                        <option value="2">1V-1101</option>
                    </select>
                        <label>Component Type</label>
                    </div>

                    <div class="input-field col col m6 s12">
                        <select>
                        <option value="" disabled selected>Choose P&ID</option>
                        <option value="1">M6-1T11-00001</option>
                        <option value="2">M6-1T11-00002</option>
                        <option value="2">M6-1T11-00003</option>
                    </select>
                        <label>P&ID</label>
                    </div>

                    <div class="input-field col col m6 s12">
                        <label>
                            <input type="checkbox" />
                            <span>Leak</span>
                        </label>
                    </div>

                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix"> note </i>
                        <input id="notes" type="text" class="validate">
                        <label for="notes">Remarks</label>
                    </div>

                    
                    <div class="file-field input-field s12">
                        <div class="btn">
                            <span>Add Media</span>
                            <input type="file" multiple>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Upload one or more files">
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <a class="btn modal-close waves-effect waves-light mr-2">Add Asset</a>
    </div>
</div>