<div style="display: none;" id="accountContainer">
	<div id="account">
		<h4>Account Setup</h4>Fields marked * are compulsory
		<br>
		<form>
			<input type="hidden" name="_account_token" id="_account_token" value="{{csrf_token()}}">
			<div class="form-group form-material floating" data-plugin="formMaterial">
				<input type="email" class="form-control" name="email" id="email" required="required" autocomplete="off" autofocus="on">
				<label class="floating-label">E-mail*</label>
				<label class="text-danger" id="emailerr"></label>
			</div>
			<div class="form-group form-material floating" data-plugin="formMaterial">
				<input type="password" class="form-control" name="password" id="password" required="required" autocomplete="off">
				<label class="floating-label">Password*</label>
				<label class="text-danger" id="pwderr"></label>
			</div>
			<div class="form-group form-material floating" data-plugin="formMaterial">
				<input type="password" class="form-control" name="cpassword" id="cpassword" required="required" autocomplete="off">
				<label class="floating-label">Confirm Password*</label>
				<label class="text-danger" id="cpwderr"></label>
			</div>
			<p>
				Password Guidelines
				<ul>
					<li>Your password must be a minimum of 8 and a maximum of 25 characters.</li>
					<li>Password must contain at least 1 Uppercase and Lower Case Character and a Special Character</li>
					<li>Only the following special characters are allowed in your password: !@#$%^&*()-_</li>
					<li>Your password may not contain spaces.</li>
					<li>Your password may not be the same as your login e-mail address.</li>
					<li>Your password will be case-sensitive.</li>
				</ul>
			</p>
			<button type="submit" class="btn btn-icon btn-raised btn-success" id="submitAccount" disabled="disabled"><i class="icon wb-plus"></i> Create Account</button>
		</form>
	</div>
</div>