@extends('layouts.master')
@section('content')
<div class="container">
	<div class="col-lg-8 col-lg-offset-1 col-md-8 col-md-offset-1 col-sm-8 col-sm-offset-1 col-xs-8 col-xs-offset-1">
		<h4>Fill in these details about yourself!</h4>
		<p>The more you fill in, the more accurately our system can match you up with people, so just be yourself and you'll do fine!</p>
			<form class="form-horizontal" method="POST" action="{{{action('UsersController@dodetails')}}}">
				<div class="form-group">
					<label for="introduction">Introduction</label><br>
					<input type="text" name="introduction" id="introduction">
				</div>
				<div class="form-group">
					<label for="about">About Me</label><br>
					<textarea name="about" id="about"></textarea>
				</div>
				<div class="form-group">
					<label for="personality">My Personality can best be summarized as...</label><br>
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
					<label for="marital_status">Marital Status</label><br>
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
					<label for="children">How many children do you have?</label><br>
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
					<label for="want_children">Do you want any/more children?</label><br>
					<select name="want_children">
						<option> - Prefer not to Say - </option>
						<option value="Yes">Yes</option>
						<option value="Maybe">Maybe</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="religion">What is your religion?</label><br>
					<select name="religion">
						<option> - Prefer not to Say - </option>
						<option value="Christian - Catholic">Christian - Catholic</option>
						<option value="Christian - Protestant">Christian - Protestant</option>
						<option value="Christian - LDS">Christian - LDS</option>
						<option value="Christian - Nondenominational">Christian - Nondemoninational</option>
						<option value="Jewish">Jewish</option>
						<option value="Islamic">Islamic</option>
						<option value="Buddhist">Buddhist</option>
						<option value="Agnostic">Agnostic</option>
						<option value="Atheist">Atheist</option>
						<option value="Rastafarian">Rastafarian</option>
						<option value="Pastafarian">Pastafarian</option>
						<option value="Hindu">Hindu</option>
						<option value="New Age">New Age</option>
						<option value="Other">Other</option>

					</select>
				</div>
				<div class="form-group">
					<label for="politics">What are your politics?</label><br>
					<select name="politics">
						<option> - Prefer not to Say - </option>
						<option value="Very Liberal">Very Liberal</option>
						<option value="Moderately Liberal">Moderately Liberal</option>
						<option value="Moderate">Moderate</option>
						<option value="Moderately Conservative">Moderately Conservative</option>
						<option value="Very Conservative">Very Conservative</option>
						<option value="Libertarian">Libertarian</option>
						<option value="Green">Green</option>
						<option value="Constitutionalist">Constitutionalist</option>
						<option value="Reform">Reform Party</option>
						<option value="Socialist">Socialist</option>
						<option value="Communist">Communist</option>
						<option value="Anarchist">Anarchist</option>
						<option value="Minarchist">Minarchist</option>
						<option value="Rent is too damn high">Rent is too damn high</option>
						<option value="Tea Party">Tea Party</option>
						<option value="Cyber Party">Cyber Party</option>
						<option value="Other">Other</option>
					</select>
				</div>
				<div class="form-group">
					<label for="job">What is your job?</label><br>
					<input type="text" name="job" id="job">
				</div>
				<div class="form-group">
					<label for="income">What is your average income?</label><br>
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
					<label for="hair_color">Hair Color</label><br>
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
					<label for="hair_length">Hair Length</label><br>
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
					<label for="eye_color">Eye Color</label><br>
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
					<label for="body_type">Body Type</label><br>
					<select name="body_type">
						<option> - Prefer not to Say - </option>
						<option value="Very Slender">Very Slender</option>
						<option value="Slender">Slender</option>
						<option value="Healthy, but not athletic">Healthy, but not athletic</option>
						<option value="Average">Average</option>
						<option value="Athletic">Athletic</option>
						<option value="Slightly above average">Slightly above average</option>
						<option value="Full">Full</option>
						<option value="Big and Beautiful">Big and Beautiful</option>
						<option value="Other">Other</option>
					</select>
				</div>
				<div class="form-group">
						<label for="height">Height</label><br>
						<input type="text" id="height" name="height">
					</div>
					<div class="form-group">
						<label for="weight">Weight</label><br>
						<input type="text" id="weight" name="weight">
					</div>
				@if($user->is_willing($user->id))
					<div class="form-group">
						<label for="can_host">Can you Host?</label><br>
						<label><input type="radio" name="can_host" value="yes">Yes</label>
						<label><input type="radio" name="can_host" value="no">No</label>
					</div>
				@endif
				<div class="form-group">
					<label for="availability_day">When are you available?</label><br>
					<select name="availability_day">
						<option> - Ask Me - </option>
						<option value="All Week">All Week</option>
						<option value="Weekdays only">Weekdays Only</option>
						<option value="Weekends only">Weekends only</option>
						<option value="Other">Other</option>
					</select>
				</div>
				<div class="form-group">
					<label for="availability_time">What times are you available?</label><br>
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
					<label for="other_features">Other Distinguishing Features</label><br>
					<textarea name="other_features"></textarea>
				</div>
				<div class="form-group">
					<label for="ideal">Describe your ideal match</label><br>
					<textarea name="ideal"></textarea>
				</div>
				<button class="btn btn-primary">Submit</button>
			</form>
	</div>
</div>
@stop