<form method="POST" action="<?= base_url('Admin/submitKabm/'.$ID);?>" id="kaprodi">
 <div class="form-row align-items-center">
  <div class="col-md mb-2 col">
    <select name="kabm" class="custom-select mr-sm-2">
      <?php foreach ($dosen->result() as $j) {
        ?>
        <option value="<?= $j->ID;?>"><?= $j->Nama;?></option>
      <?php } ?>
    </select>
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-4">Submit</button>
  </div>
</div>
</form>