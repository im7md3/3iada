<div class="modal fade" id="delete_agent{{$mark->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.marks.destroy',$mark) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    {{ __('admin.are sure of the deleting process?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">{{ __('No') }}</button>
                    <button class="btn btn-sm  btn-danger" type="submit" data-bs-dismiss="modal">{{ __('Yes') }}</button>
                </div>
            </form>
        </div>

    </div>
</div>
