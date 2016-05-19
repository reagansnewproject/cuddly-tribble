@extends('layouts.master')
@section('content')
<h4>Edit your information</h4>
<form class="form-horizontal" method="POST" action="{{{action('UsersController@doedit', $user->id)}}}">
	<div class="form-group">
		@if($errors->has('username'))
			<span class="error">{{{$errors->first('username')}}}</span><br>
		@endif
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="{{{$user->username}}}">
	</div>
	<div class="form-group">
		@if($errors->has('email'))
			<span class="error">{{{$errors->first('email')}}}</span><br>
		@endif
		<label for="email">Email</label>
		<input type="text" name="email" id="email" value="{{{$user->email}}}">
	</div>
	<div class="form-group">
		@if($errors->has('preference'))
			<span class="error">{{{$errors->first('preference')}}}</span><br>
		@endif
		<label for="preference">I am looking for someone who is: </label>
			<label><input type="radio" name="preference" id="preference1" value="Female" <?php if($user->preference == "Female") {?> checked <?php }?>>Female</label>
			<label><input type="radio" name="preference" id="preference2" value="Male" <?php if($user->preference == "Male") {?> checked <?php }?>>Male</label>
			<label><input type="radio" name="preference" id="preference3" value="All" <?php if($user->preference == "All") {?> checked <?php }?>>Either Male or Female</label>
	</div>
	<div class="form-group">
		@if($errors->has('state'))
			<span class="error">{{{$errors->first('state')}}}</span><br>
		@endif
		<label for="state">State</label>
				<select name="state">
					<option disabled> - State - </option>
					<option <?php if($user->state == "AL") {?> selected <?php }?> value="AL">AL</option>
					<option <?php if($user->state == "AK") {?> selected <?php }?> value="AK">AK</option>
					<option <?php if($user->state == "AZ") {?> selected <?php }?> value="AZ">AZ</option>
					<option <?php if($user->state == "AR") {?> selected <?php }?> value="AR">AR</option>
					<option <?php if($user->state == "CA") {?> selected <?php }?> value="CA">CA</option>
					<option <?php if($user->state == "CO") {?> selected <?php }?> value="CO">CO</option>
					<option <?php if($user->state == "CT") {?> selected <?php }?> value="CT">CT</option>
					<option <?php if($user->state == "DE") {?> selected <?php }?> value="DE">DE</option>
					<option <?php if($user->state == "FL") {?> selected <?php }?> value="FL">FL</option>
					<option <?php if($user->state == "GA") {?> selected <?php }?> value="GA">GA</option>
					<option <?php if($user->state == "HI") {?> selected <?php }?> value="HI">HI</option>
					<option <?php if($user->state == "ID") {?> selected <?php }?> value="ID">ID</option>
					<option <?php if($user->state == "IL") {?> selected <?php }?> value="IL">IL</option>
					<option <?php if($user->state == "IN") {?> selected <?php }?> value="IN">IN</option>
					<option <?php if($user->state == "IA") {?> selected <?php }?> value="IA">IA</option>
					<option <?php if($user->state == "KS") {?> selected <?php }?> value="KS">KS</option>
					<option <?php if($user->state == "KY") {?> selected <?php }?> value="KY">KY</option>
					<option <?php if($user->state == "LA") {?> selected <?php }?> value="LA">LA</option>
					<option <?php if($user->state == "ME") {?> selected <?php }?> value="ME">ME</option>
					<option <?php if($user->state == "MD") {?> selected <?php }?> value="MD">MD</option>
					<option <?php if($user->state == "MA") {?> selected <?php }?> value="MA">MA</option>
					<option <?php if($user->state == "MI") {?> selected <?php }?> value="MI">MI</option>
					<option <?php if($user->state == "MN") {?> selected <?php }?> value="MN">MN</option>
					<option <?php if($user->state == "MS") {?> selected <?php }?> value="MS">MS</option>
					<option <?php if($user->state == "MO") {?> selected <?php }?> value="MO">MO</option>
					<option <?php if($user->state == "MT") {?> selected <?php }?> value="MT">MT</option>
					<option <?php if($user->state == "NE") {?> selected <?php }?> value="NE">NE</option>
					<option <?php if($user->state == "NV") {?> selected <?php }?> value="NV">NV</option>
					<option <?php if($user->state == "NH") {?> selected <?php }?> value="NH">NH</option>
					<option <?php if($user->state == "NJ") {?> selected <?php }?> value="NJ">NJ</option>
					<option <?php if($user->state == "NM") {?> selected <?php }?> value="NM">NM</option>
					<option <?php if($user->state == "NY") {?> selected <?php }?> value="NY">NY</option>
					<option <?php if($user->state == "NC") {?> selected <?php }?> value="NC">NC</option>
					<option <?php if($user->state == "ND") {?> selected <?php }?> value="ND">ND</option>
					<option <?php if($user->state == "OH") {?> selected <?php }?> value="OH">OH</option>
					<option <?php if($user->state == "OK") {?> selected <?php }?> value="OK">OK</option>
					<option <?php if($user->state == "OR") {?> selected <?php }?> value="OR">OR</option>
					<option <?php if($user->state == "PA") {?> selected <?php }?> value="PA">PA</option>
					<option <?php if($user->state == "RI") {?> selected <?php }?> value="RI">RI</option>
					<option <?php if($user->state == "SC") {?> selected <?php }?> value="SC">SC</option>
					<option <?php if($user->state == "SD") {?> selected <?php }?> value="SD">SD</option>
					<option <?php if($user->state == "TN") {?> selected <?php }?> value="TN">TN</option>
					<option <?php if($user->state == "TX") {?> selected <?php }?> value="TX">TX</option>
					<option <?php if($user->state == "UT") {?> selected <?php }?> value="UT">UT</option>
					<option <?php if($user->state == "VT") {?> selected <?php }?> value="VT">VT</option>
					<option <?php if($user->state == "VA") {?> selected <?php }?> value="VA">VA</option>
					<option <?php if($user->state == "WA") {?> selected <?php }?> value="WA">WA</option>
					<option <?php if($user->state == "WV") {?> selected <?php }?> value="WV">WV</option>
					<option <?php if($user->state == "WI") {?> selected <?php }?> value="WI">WI</option>
					<option <?php if($user->state == "WY") {?> selected <?php }?> value="WY">WY</option>
				</select>
	</div>
	<div class="form-group">
		@if($errors->has('city'))
			<span class="error">{{{$errors->first('city')}}}</span><br>
		@endif
		<label for="city">City</label>
		<input type="text" name="city" id="city" value="{{{$user->city}}}">
	</div>
	<div class="form-group">
		@if($errors->has('zipcode'))
			<span class="error">{{{$errors->first('zipcode')}}}</span><br>
		@endif
		<label for="zipcode">Zip</label>
		<input type="number" name="zipcode" id="zipcode" value="{{{$user->zipcode}}}">
	</div>
	<div class="form-group">
		@if($errors->has('willing'))
			<span class="error">{{{$errors->first('willing')}}}</span><br>
		@endif
		<label for="willing">Are you looking to Hookup?</label>
		<label><input type="radio" name="willing" value="Yes" <?php if($user->willing == "Yes") {?> checked <?php } ?>>Yes</label>
		<label><input type="radio" name="willing" value="No" <?php if($user->willing == "No") {?> checked <?php } ?>>No</label>
	</div>
	@foreach($details as $detail)
	<div class="form-group">
		@if($errors->has('introduction'))
			<span class="error">{{{$errors->first('introduction')}}}</span><br>
		@endif
			<label for="introduction">Introduction</label>
			<input type="text" name="introduction" id="introduction" value="{{{$detail->introduction}}}">
		</div>
		<div class="form-group">
			@if($errors->has('about'))
			<span class="error">{{{$errors->first('about')}}}</span><br>
		@endif
			<label for="about">About Me</label>
			<textarea name="about" id="about">{{{$detail->about_me}}}</textarea>
		</div>
		<div class="form-group">
			@if($errors->has('personality'))
			<span class="error">{{{$errors->first('personality')}}}</span><br>
		@endif
			<label for="personality">My Personality can best be summarized as...</label>
			<select name="personality">
				<option> - Prefer not to Say - </option>
				<option value="Timid" <?php if($detail->personality == "Timid") {?> selected <?php } ?>>Timid</option>
				<option value="Sassy" <?php if($detail->personality == "Sassy") {?> selected <?php } ?>>Sassy</option>
				<option value="Stubborn" <?php if($detail->personality == "Stubborn") {?> selected <?php } ?>>Stubborn</option>
				<option value="Laid Back" <?php if($detail->personality == "Laid Back") {?> selected <?php } ?>>Laid Back</option>
				<option value="Aggressive" <?php if($detail->personality == "Aggressive") {?> selected <?php } ?>>Aggressive</option>
				<option value="Spiritual" <?php if($detail->personality == "Spiritual") {?> selected <?php } ?>>Spiritual</option>
				<option value="Other" <?php if($detail->personality == "Other") {?> selected <?php } ?>>Other</option>
			</select>
		</div>
		<div class="form-group">
			@if($errors->has('marital_status'))
			<span class="error">{{{$errors->first('marital_status')}}}</span><br>
		@endif
			<label for="marital_status">Marital Status</label>
			<select name="marital_status">
				<option> - Prefer not to Say - </option>
				<option value="Single - Never Been Married" <?php if($detail->marital_status == "Single - Never Been Married") {?> selected <?php } ?>>Single - Never Been Married</option>
				<option value="In a Relationship" <?php if($detail->marital_status == "In a Relationship") {?> selected <?php } ?>>In a Relationship</option>
				<option value="Married" <?php if($detail->marital_status == "Married") {?> selected <?php } ?>>Married</option>
				<option value="Divorced" <?php if($detail->marital_status == "Divorced") {?> selected <?php } ?>>Divorced</option>
				<option value="Widowed" <?php if($detail->marital_status == "Widowed") {?> selected <?php } ?>>Widowed</option>
			</select>
		</div>
		<div class="form-group">
			@if($errors->has('children'))
			<span class="error">{{{$errors->first('children')}}}</span><br>
		@endif
			<label for="children">How many children do you have?</label>
			<select name="children">
				<option> - Prefer not to Say - </option>
				<option value="None" <?php if($detail->children == "None") {?> selected <?php } ?>>None</option>
				<option value="1" <?php if($detail->children == "1") {?> selected <?php } ?>>1</option>
				<option value="2" <?php if($detail->children == "2") {?> selected <?php } ?>>2</option>
				<option value="3" <?php if($detail->children == "3") {?> selected <?php } ?>>3</option>
				<option value="4" <?php if($detail->children == "4") {?> selected <?php } ?>>4</option>
				<option value="5" <?php if($detail->children == "5") {?> selected <?php } ?>>5</option>
				<option value="More than 5" <?php if($detail->children == "More than 5") {?> selected <?php } ?>>More than 5</option>
			</select>
		</div>
		<div class="form-group">
			@if($errors->has('want_children'))
			<span class="error">{{{$errors->first('want_children')}}}</span><br>
		@endif
			<label for="want_children">Do you want any/more children?</label>
			<select name="want_children">
				<option> - Prefer not to Say - </option>
				<option value="Yes" <?php if($detail->want_children == "Yes") {?> selected <?php } ?>>Yes</option>
				<option value="Maybe" <?php if($detail->want_children == "Maybe") {?> selected <?php } ?>>Maybe</option>
				<option value="No" <?php if($detail->want_children == "No") {?> selected <?php } ?>>No</option>
			</select>
		</div>
		<div class="form-group">
			@if($errors->has('religion'))
			<span class="error">{{{$errors->first('religion')}}}</span><br>
		@endif
			<label for="religion">What is your religion?</label>
			<select name="religion">
				<option> - Prefer not to Say - </option>
				<option value="Christian - Catholic" <?php if($detail->religion == "Christian - Catholic") {?> selected <?php } ?>>Christian - Catholic</option>
				<option value="Christian - Protestant" <?php if($detail->religion == "Christian - Protestant") {?> selected <?php } ?>>Christian - Protestant</option>
				<option value="Christian - LDS" <?php if($detail->religion == "Christian - LDS") {?> selected <?php } ?>>Christian - LDS</option>
				<option value="Jewish" <?php if($detail->religion == "Jewish") {?> selected <?php } ?>>Jewish</option>
				<option value="Islamic" <?php if($detail->religion == "Islamic") {?> selected <?php } ?>>Islamic</option>
				<option value="Buddhist" <?php if($detail->religion == "Buddhist") {?> selected <?php } ?>>Buddhist</option>
				<option value="Agnostic" <?php if($detail->religion == "Agnostic") {?> selected <?php } ?>>Agnostic</option>
				<option value="Atheist" <?php if($detail->religion == "Atheist") {?> selected <?php } ?>>Atheist</option>
				<option value="Other" <?php if($detail->religion == "Other") {?> selected <?php } ?>>Other</option>

			</select>
		</div>
		<div class="form-group">
			@if($errors->has('job'))
			<span class="error">{{{$errors->first('job')}}}</span><br>
		@endif
			<label for="job">What is your job?</label>
			<input type="text" name="job" id="job" value="{{{$detail->job}}}">
		</div>
		<div class="form-group">
			@if($errors->has('income'))
			<span class="error">{{{$errors->first('income')}}}</span><br>
		@endif
			<label for="income">What is your average income?</label>
			<select name="income">
				<option> - Prefer not to Say - </option>
				<option value="Under $25k" <?php if($detail->income == "Under $25k") {?> selected <?php } ?>>Under $25k</option>
				<option value="$25k-$35k" <?php if($detail->income == "$25k-$35k") {?> selected <?php } ?>>$25k-$35k</option>
				<option value="$35k-$50k" <?php if($detail->income == "$35k-$50k") {?> selected <?php } ?>>$35k-$50k</option>
				<option value="$50k-$75k" <?php if($detail->income == "$50k-$75k") {?> selected <?php } ?>>$50k-$75k</option>
				<option value="$75k-$100k" <?php if($detail->income == "$75k-$100k") {?> selected <?php } ?>>$75k-$100k</option>
				<option value="Over $100k" <?php if($detail->income == "Over $100k") {?> selected <?php } ?>>Over $100k</option>
			</select>
		</div>
		<div class="form-group">
			@if($errors->has('hair_color'))
			<span class="error">{{{$errors->first('hair_color')}}}</span><br>
		@endif
			<label for="hair_color">Hair Color</label>
			<select name="hair_color">
				<option> - Prefer not to Say - </option>
				<option value="Light Brown" <?php if($detail->hair_color == "Light Brown") {?> selected <?php } ?>>Light Brown</option>
				<option value="Dark Brown" <?php if($detail->hair_color == "Dark Brown") {?> selected <?php } ?>>Dark Brown</option>
				<option value="Black" <?php if($detail->hair_color == "Black") {?> selected <?php } ?>>Black</option>
				<option value="Red" <?php if($detail->hair_color == "Red") {?> selected <?php } ?>>Red</option>
				<option value="Blonde" <?php if($detail->hair_color == "Blonde") {?> selected <?php } ?>>Blonde</option>
				<option value="Other" <?php if($detail->hair_color == "Other") {?> selected <?php } ?>>Other</option>
			</select>
		</div>
		<div class="form-group">
			@if($errors->has('hair_length'))
			<span class="error">{{{$errors->first('hair_length')}}}</span><br>
		@endif
			<label for="hair_length">Hair Length</label>
			<select name="hair_length">
				<option> - Prefer not to Say - </option>
				<option value="None" <?php if($detail->hair_length == "None") {?> selected <?php } ?>>None</option>
				<option value="Short" <?php if($detail->hair_length == "Short") {?> selected <?php } ?>>Short</option>
				<option value="Medium" <?php if($detail->hair_length == "Medium") {?> selected <?php } ?>>Medium</option>
				<option value="Long" <?php if($detail->hair_length == "Long") {?> selected <?php } ?>>Long</option>
				<option value="Very Long" <?php if($detail->hair_length == "Very Long") {?> selected <?php } ?>>Very Long</option>
				<option value="Other" <?php if($detail->hair_length == "Other") {?> selected <?php } ?>>Other</option>
			</select>
		</div>
		<div class="form-group">
			@if($errors->has('eye_color'))
			<span class="error">{{{$errors->first('eye_color')}}}</span><br>
		@endif
			<label for="eye_color">Eye Color</label>
			<select name="eye_color">
				<option> - Prefer not to Say - </option>
				<option value="Blue" <?php if($detail->eye_color == "Blue") {?> selected <?php } ?>>Blue</option>
				<option value="Green" <?php if($detail->eye_color == "Green") {?> selected <?php } ?>>Green</option>
				<option value="Brown" <?php if($detail->eye_color == "Brown") {?> selected <?php } ?>>Brown</option>
				<option value="Hazel" <?php if($detail->eye_color == "Hazel") {?> selected <?php } ?>>Hazel</option>
				<option value="Black" <?php if($detail->eye_color == "Black") {?> selected <?php } ?>>Black</option>
				<option value="Other" <?php if($detail->eye_color == "Other") {?> selected <?php } ?>>Other</option>
			</select>
		</div>
		<div class="form-group">
			@if($errors->has('body_type'))
			<span class="error">{{{$errors->first('body_type')}}}</span><br>
		@endif
			<label for="body_type">Body Type</label>
			<select name="body_type">
				<option> - Prefer not to Say - </option>
				<option value="Slender" <?php if($detail->body_type == "Slender") {?> selected <?php } ?>>Slender</option>
				<option value="Average" <?php if($detail->body_type == "Average") {?> selected <?php } ?>>Average</option>
				<option value="Athletic" <?php if($detail->body_type == "Athletic") {?> selected <?php } ?>>Athletic</option>
				<option value="Full" <?php if($detail->body_type == "Full") {?> selected <?php } ?>>Full</option>
				<option value="Other" <?php if($detail->body_type == "Other") {?> selected <?php } ?>>Other</option>
			</select>
		</div>
		<div class="form-group">
			@if($errors->has('height'))
			<span class="error">{{{$errors->first('height')}}}</span><br>
		@endif
				<label for="height">Height</label>
				<input type="text" id="height" name="height" value="{{{$detail->height}}}">
			</div>
			<div class="form-group">
				@if($errors->has('weight'))
			<span class="error">{{{$errors->first('weight')}}}</span><br>
		@endif
				<label for="weight">Weight</label>
				<input type="text" id="weight" name="weight" value="{{{$detail->weight}}}">
			</div>
		@if($user->is_willing($user->id))
			<div class="form-group">
				<label for="can_host">Can you Host?</label>
				<label><input type="radio" name="can_host" value="yes" <?php if($detail->can_host == "yes") {?> checked <?php } ?>>Yes</label>
				<label><input type="radio" name="can_host" value="no" <?php if($detail->can_host == "no") {?> checked <?php } ?>>No</label>
			</div>
		@endif
		<div class="form-group">
			@if($errors->has('availability_day'))
			<span class="error">{{{$errors->first('availability_day')}}}</span><br>
		@endif
			<label for="availability_day">When are you available?</label>
			<select name="availability_day">
				<option> - Ask Me - </option>
				<option value="All Week" <?php if($detail->availability_day == "All Week") {?> selected <?php } ?>>All Week</option>
				<option value="Weekdays only" <?php if($detail->availability_day == "Weekdays only") {?> selected <?php } ?>>Weekdays Only</option>
				<option value="Weekends only" <?php if($detail->availability_day == "Weekends only") {?> selected <?php } ?>>Weekends only</option>
				<option value="Other" <?php if($detail->availability_day == "Other") {?> selected <?php } ?>>Other</option>
			</select>
		</div>
		<div class="form-group">
			@if($errors->has('availability_time'))
			<span class="error">{{{$errors->first('availability_time')}}}</span><br>
		@endif
			<label for="availability_time">What times are you available?</label>
			<select name="availability_time">
				<option> - Ask Me - </option>
				<option value="All Day" <?php if($detail->availability_time == "All Day") {?> selected <?php } ?>>All Day</option>
				<option value="Mornings only" <?php if($detail->availability_time == "Mornings only") {?> selected <?php } ?>>Mornings only</option>
				<option value="Afternoons only" <?php if($detail->availability_time == "Afternoons only") {?> selected <?php } ?>>Afternoons only</option>
				<option value="Evenings only" <?php if($detail->availability_time == "Evenings only") {?> selected <?php } ?>>Evenings only</option>
				<option value="Mornings and Afternoons" <?php if($detail->availability_time == "Mornings and Afternoons") {?> selected <?php } ?>>Mornings and Afternoons</option>
				<option value="Afternoons and Evenings" <?php if($detail->availability_time == "Afternoons and Evenings") {?> selected <?php } ?>>Afternoons and Evenings</option>
				<option value="Evenings and Mornings" <?php if($detail->availability_time == "Evenings and Mornings") {?> selected <?php } ?>>Evenings and Mornings</option>
			</select>
		</div>
		<div class="form-group">
			@if($errors->has('other_features'))
			<span class="error">{{{$errors->first('other_features')}}}</span><br>
		@endif
			<label for="other_features">Other Distinguishing Features</label>
			<textarea name="other_features">{{{$detail->other_features}}}</textarea>
		</div>
		<div class="form-group">
			@if($errors->has('ideal'))
			<span class="error">{{{$errors->first('ideal')}}}</span><br>
		@endif
			<label for="ideal">Describe your ideal match</label>
			<textarea name="ideal">{{{$detail->ideal}}}</textarea>
		</div>
		@endforeach
	<button class="btn btn-primary">Edit</button>
</form>
@stop