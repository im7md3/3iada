<section>
  <div class="d-flex align-items-start">
    <div class="table-responsive w-100">
      <table class="table main-table mb-1">
        <thead>
          <tr>
            <th colspan="12" class="border">العين اليسرى (L)(Left)</th>
          </tr>
          <tr>
            <th>AX</th>
            <th>CYL</th>
            <th>SPH</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="number" step="any" value="0" wire:model.defer='left_eye_distance_axis' class="form-control"></td>
            <td><input type="number" step="any"  value="0" wire:model.defer ='left_eye_distance_cylinder' class="form-control"></td>
            <td><input type="number" step="any"  value="0" wire:model.defer ='left_eye_distance_sphere'  class="form-control"></td>
          </tr>
          <!-- For Near -->
          <tr>
              <td><input type="number" step="any"  value="0" wire:model.defer='left_eye_near_axis' class="form-control"></td>
              <td><input type="number" step="any"  value="0" wire:model.defer ='left_eye_near_cylinder' class="form-control"></td>
              <td><input type="number" step="any"  value="0" wire:model.defer ='left_eye_near_sphere'  class="form-control"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="table-responsive w-100">
      <table class="table main-table mb-1">
        <thead>
          <tr>
            <th colspan="12" class="border">العين اليمنى (R)(Right)</th>
          </tr>
          <tr>
            <th>AX</th>
            <th>CYL</th>
            <th>SPH</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
              <td><input type="number" step="any"  value="0" wire:model.defer='right_eye_distance_axis' class="form-control"></td>
              <td><input type="number" step="any"  value="0" wire:model.defer ='right_eye_distance_cylinder' class="form-control"></td>
              <td><input type="number" step="any"  value="0" wire:model.defer ='right_eye_distance_sphere'  class="form-control"></td>
              <td class="border">Diest</td>
          </tr>
          <!-- For Near -->
          <tr>
              <td><input type="number" step="any"  value="0" wire:model.defer='right_eye_near_axis' class="form-control"></td>
              <td><input type="number" step="any"  value="0" wire:model.defer ='right_eye_near_cylinder' class="form-control"></td>
              <td><input type="number" step="any"  value="0" wire:model.defer ='right_eye_near_sphere'  class="form-control"></td>
              <td class="border">Near</td>
          </tr>


        </tbody>
      </table>
        <button wire:click="addVisionTest" class="btn btn-success">{{ __('admin.Save') }}</button>
    </div>
  </div>
</section>
