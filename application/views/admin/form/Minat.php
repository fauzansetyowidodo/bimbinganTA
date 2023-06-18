<head>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#jrsn").change(function(){ 
        $("#prodi").hide();
        $.ajax({
          type: "POST", 
          url: "<?= base_url("Admin/filterKabm"); ?>", 
          data: {id_prodi : $("#jrsn").val()}, 
          dataType: "json",
          success: function(response){ 
            $("#view").show('fast', function() {
              $("#dsn").html(response.list).show();  
            });
          },
        });
      });
    });
  </script>
</head>

<?php if ($prodi) { ?>
  <form action="<?= base_url('Admin/saveMinat');?>" method="post">
    <div class="form-row align-items-center mb-4">
      <div class="col-md mb-2">
        <label class="sr-only" for="inlineFormInput">ID Bidang Minat</label>
        <input min="0" type="number" class="form-control mb-s4 form-control-sm" placeholder="ID Bidang Minat" name="id" required>
      </div>
      <div class="col-md mb-2">
        <input type="text" name="minat" class="form-control form-control-sm" id="inlineFormInputGroup" placeholder="Bidang Minat" required>
      </div>
      <div class="col-md col">
        <select name="id_prodi" class="custom-select mr-sm-2 form-control-sm" id="jrsn">
          <option selected>Program Studi</option>
          <?php foreach ($prodi->result() as $j) { ?>  
            <option value="<?= $j->IDProdi;?>"><?= $j->Prodi;?></option>
          <?php } ?>
        </select>
      </div>
      <?php if ($users) { ?>
        <div class="col-md col" style="display: none" id="view">
          <select name="prodi" class="custom-select mr-sm-2 form-control-sm" id="dsn">
          </select>
        </div>
      <?php } ?>
      <div class="col-auto">
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
      </div>
    </div>
  </form>  
<?php } else { ?>
  <div class="col-md-auto text-center">
    <?= $result ?>
  </div>
<?php } ?>
