<div class="modal fade" id="delete_agent{{$bank->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف  الحساب {{$bank->account_name}}</h5>
                <button type="button" class="btn-close ms-0 me-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    هل أنت متأكد من حذف الحساب البنكي {{$bank->account_name}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">لا</button>
                    <button class="btn btn-sm btn-primary" type="submit" wire:click="delete({{$bank}})" data-bs-dismiss="modal">نعم</button>
                </div>

            </form>
        </div>
    </div>
</div>
