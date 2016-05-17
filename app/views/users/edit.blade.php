@extends('layouts.master')
@section('content')
<h4>Edit your information</h4>
<form class="form-horizontal" method="POST" action="{{{action('UsersController@doedit', $user->id)}}}">
	<div class="form-group">
		<label for="preference">I am looking for someone who is: </label>
			<label><input type="radio" name="preference" id="preference1" value="Female">Female</label>
			<label><input type="radio" name="preference" id="preference2" value="Male">Male</label>
			<label><input type="radio" name="preference" id="preference3" value="All">Either Male or Female</label>
	</div>
	<div class="form-group">
		<label for="state">State</label>
				<select name="state">
					<option disabled> - State - </option>
					<option value="AL">AL</option>
					<option value="AK">AK</option>
					<option value="AZ">AZ</option>
					<option value="AR">AR</option>
					<option value="CA">CA</option>
					<option value="CO">CO</option>
					<option value="CT">CT</option>
					<option value="DE">DE</option>
					<option value="FL">FL</option>
					<option value="GA">GA</option>
					<option value="HI">HI</option>
					<option value="ID">ID</option>
					<option value="IL">IL</option>
					<option value="IN">IN</option>
					<option value="IA">IA</option>
					<option value="KS">KS</option>
					<option value="KY">KY</option>
					<option value="LA">LA</option>
					<option value="ME">ME</option>
					<option value="MD">MD</option>
					<option value="MA">MA</option>
					<option value="MI">MI</option>
					<option value="MN">MN</option>
					<option value="MS">MS</option>
					<option value="MO">MO</option>
					<option value="MT">MT</option>
					<option value="NE">NE</option>
					<option value="NV">NV</option>
					<option value="NH">NH</option>
					<option value="NJ">NJ</option>
					<option value="NM">NM</option>
					<option value="NY">NY</option>
					<option value="NC">NC</option>
					<option value="ND">ND</option>
					<option value="OH">OH</option>
					<option value="OK">OK</option>
					<option value="OR">OR</option>
					<option value="PA">PA</option>
					<option value="RI">RI</option>
					<option value="SC">SC</option>
					<option value="SD">SD</option>
					<option value="TN">TN</option>
					<option value="TX">TX</option>
					<option value="UT">UT</option>
					<option value="VT">VT</option>
					<option value="VA">VA</option>
					<option value="WA">WA</option>
					<option value="WV">WV</option>
					<option value="WI">WI</option>
					<option value="WY">WY</option>
				</select>
	</div>
	<div class="form-group">
		<label for="city">City</label>
		<input type="text" name="city" id="city">
	</div>
	<div class="form-group">
		<label for="zipcode">Zip</label>
		<input type="number" name="zipcode" id="zipcode">
	</div>
	<div class="form-group">
		<label for="willing">Are you looking to Hookup?</label>
		<label><input type="radio" name="willing" value="Yes">Yes</label>
		<label><input type="radio" name="willing" value="No">No</label>
	</div>
	<div class="form-group">
			<label for="introduction">Introduction</label>
			<input type="text" name="introduction" id="introduction">
		</div>
		<div class="form-group">
			<label for="about">About Me</label>
			<textarea name="about" id="about"></textarea>
		</div>
		<div class="form-group">
			<label for="personality">My Personality can best be summarized as...</label>
			<select name="personality">
				<option> - Prefer not to Say - </option>
				<option value="Timid">Timid</option>
				<option value="Sassy">Sassy</option>
				<option value="Stubborn">Stubborn</option>
				<option value="Laid Back">Laid Back</option>
				<option value="Aggressive">Aggressive</option>
				<option value="Spiritual">Spiritual</option>
				<option value="Other">Other</option>
			</select>
		</div>
		<div class="form-group">
			<label for="marital_status">Marital Status</label>
			<select name="marital_status">
				<option> - Prefer not to Say - </option>
				<option value="Single - Never Been Married">Single - Never Been Married</option>
				<option value="In a Relationship">In a Relationship</option>
				<option value="Married">Married</option>
				<option value="Divorced">Divorced</option>
				<option value="Widowed">Widowed</option>
			</select>
		</div>
		<div class="form-group">
			<label for="children">How many children do you have?</label>
			<select name="children">
				<option> - Prefer not to Say - </option>
				<option value="None">None</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value-"More than 5">More than 5</option>
			</select>
		</div>
		<div class="form-group">
			<label for="want_children">Do you want any/more children?</label>
			<select name="want_children">
				<option> - Prefer not to Say - </option>
				<option value="Yes">Yes</option>
				<option value="Maybe">Maybe</option>
				<option value="No">No</option>
			</select>
		</div>
		<div class="form-group">
			<label for="religion">What is your religion?</label>
			<select name="religion">
				<option> - Prefer not to Say - </option>
				<option value="Christian - Catholic">Christian - Catholic</option>
				<option value="Christian - Protestant">Christian - Protestant</option>
				<option value="Christian - LDS">Christian - LDS</option>
				<option value="Jewish">Jewish</option>
				<option value="Islamic">Islamic</option>
				<option value="Buddhist">Buddhist</option>
				<option value="Agnostic">Agnostic</option>
				<option value="Atheist">Atheist</option>
				<option value="Other">Other</option>

			</select>
		</div>
		<div class="form-group">
			<label for="job">What is your job?</label>
			<input type="text" name="job" id="job">
		</div>
		<div class="form-group">
			<label for="income">What is your average income?</label>
			<select name="income">
				<option> - Prefer not to Say - </option>
				<option value="Under $25k">Under $25k</option>
				<option value="$25k-$35k">$25k-$35k</option>
				<option value="$35k-$50k">$35k-$50k</option>
				<option value="$50k-$75k">$50k-$75k</option>
				<option value="$75k-$100k">$75k-$100k</option>
				<option value="Over $100k">Over $100k</option>
			</select>
		</div>
		<div class="form-group">
			<label for="hair_color">Hair Color</label>
			<select name="hair_color">
				<option> - Prefer not to Say - </option>
				<option value="Light Brown">Light Brown</option>
				<option value="Dark Brown">Dark Brown</option>
				<option value="Black">Black</option>
				<option value="Red">Red</option>
				<option value="Blonde">Blonde</option>
				<option value="Other">Other</option>
			</select>
		</div>
		<div class="form-group">
			<label for="hair_length">Hair Length</label>
			<select name="hair_length">
				<option> - Prefer not to Say - </option>
				<option value="None">None</option>
				<option value="Short">Short</option>
				<option value="Medium">Medium</option>
				<option value="Long">Long</option>
				<option value="Very Long">Very Long</option>
				<option value="Other">Other</option>
			</select>
		</div>
		<div class="form-group">
			<label for="eye_color">Eye Color</label>
			<select name="eye_color">
				<option> - Prefer not to Say - </option>
				<option value="Blue">Blue</option>
				<option value="Green">Green</option>
				<option value="Brown">Brown</option>
				<option value="Hazel">Hazel</option>
				<option value="Black">Black</option>
				<option value="Other">Other</option>
			</select>
		</div>
		<div class="form-group">
			<label for="body_type">Body Type</label>
			<select name="body_type">
				<option> - Prefer not to Say - </option>
				<option value="Slender">Slender</option>
				<option value="Average">Average</option>
				<option value="Athletic">Athletic</option>
				<option value="Full">Full</option>
				<option value="Other">Other</option>
			</select>
		</div>
		<div class="form-group">
				<label for="height">Height</label>
				<input type="text" id="height" name="height">
			</div>
			<div class="form-group">
				<label for="weight">Weight</label>
				<input type="text" id="weight" name="weight">
			</div>
		@if($user->is_willing())
			<div class="form-group">
				<label for="can_host">Can you Host?</label>
				<label><input type="radio" name="can_host" value="yes">Yes</label>
				<label><input type="radio" name="can_host" value="no">No</label>
			</div>
		@endif
		<div class="form-group">
			<label for="availability_day">When are you available?</label>
			<select name="availability_day">
				<option> - Ask Me - </option>
				<option value="All Week">All Week</option>
				<option value="Weekdays only">Weekdays Only</option>
				<option value="Weekends only">Weekends only</option>
				<option value="Other">Other</option>
			</select>
		</div>
		<div class="form-group">
			<label for="availability_time">What times are you available?</label>
			<select name="availability_time">
				<option> - Ask Me - </option>
				<option value="All Day">All Day</option>
				<option value="Mornings only">Mornings only</option>
				<option value="Afternoons only">Afternoons only</option>
				<option value="Evenings only">Evenings only</option>
				<option value="Mornings and Afternoons">Mornings and Afternoons</option>
				<option value="Afternoons and Evenings">Afternoons and Evenings</option>
				<option value="Evenings and Mornings">Evenings and Mornings</option>
			</select>
		</div>
		<div class="form-group">
			<label for="other_features">Other Distinguishing Features</label>
			<textarea name="other_features"></textarea>
		</div>
		<div class="form-group">
			<label for="ideal">Describe your ideal match</label>
			<textarea name="ideal"></textarea>
		</div>
	<button class="btn btn-primary">Edit</button>
</form>
@stop