<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label class="form-label" for="new_password">New Password</label>
            <input type="password" class="form-control" id="new_password" placeholder="New Password" name="new_password">
            <span id="new_password_error" class="error"></span>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label class="form-label" for="confirm_pass">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_pass" name="confirm_pass" placeholder="Confirm Password">
            <span id="confirm_pass_error" class="error"></span>
        </div>
    </div>
    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{$id}}">
</div>