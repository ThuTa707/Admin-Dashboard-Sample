
{{-- PW Change Button --}}

<button type="button" class="btn btn-sm btn-outline-warning" data-toggle="modal"
data-target="#passwordChangeModal{{$user->id}}">
Password Change
</button>

<!-- Modal -->

<div class="modal fade" id="passwordChangeModal{{$user->id}}" data-backdrop="static"
tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Change
                Password
            </h5>
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form
                action="{{ route('admin.change.newPassword') }}"
                method="post" id="passwordChange{{ $user->id }}">
                @csrf
            <input type="hidden" name="id" value="{{$user->id}}">
                <div class="form-group">
                    <label>
                        <i class="mr-1 feather-lock"></i>
                        Password
                    </label>
                    <input type="password" name="newpassword"
                        class="form-control" required>
                    @error('newpassword')
                        <small
                            class="font-weight-bold text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </form>


        </div> 
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary"
                form="passwordChange{{ $user->id }}">Change</button>
        </div>
    </div>
</div>
</div>
