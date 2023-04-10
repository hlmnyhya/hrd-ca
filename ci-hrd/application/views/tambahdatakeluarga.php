<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>TAMBAH DATA KELUARGA</h2>
                </div>
            </div>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="form-group">
                    <input type="hidden" class=" form-control col-md-4" name="" id="formGroupExampleInput2"
                        placeholder="">
                </div>
                <div class="form-group">
                    <input type="hidden" class=" form-control col-md-4" name="" id="formGroupExampleInput2"
                        placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Nama</label>
                    <input type="text" class="form-control col-md-6" name="" id="formGroupExampleInput2" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInp ut2">Hubungan</label>
                    <input type="text" class="form-control col-md-6" name="" id="formGroupExampleInput2" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Tanggal Lahir</label>
                    <input type="date" class="form-control col-md-6" name="" id="formGroupExampleInput2" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Jenis Kelamin</label>
                    <select class="form-control col-md-6" name="asli" require="true">
                        <option selected disabled>--Pilih--</option>
                        <option>Laki-Laki</option>
                        <option>Perempuan</option>
                    </select>
                </div>
                <br>
                <td>
                    <a href="<?php echo base_url('tambahdatapribadi')?>"><button class="btn btn-danger btn-"><i
                                class="fa fa-arrow-circle-left">
                            </i> Back</button></a>
                    <a href="<?php echo base_url('tambahdatagolongan')?>"><button class="btn btn-primary btn-">Next <i
                                class="fa fa-arrow-circle-right">
                            </i></button></a>
                </td>
                </form>
            </main>
        </div>