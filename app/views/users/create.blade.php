@extends('layouts.master')
@section('content')
<div class="container">
	<div class="col-lg-8 col-lg-offset-3">
		<form class="form-horizontal" action="{{{action('UsersController@store')}}}" method="POST">
			<div class="form-group">
				@if($errors->has('username'))
					{{{$errors->first('username')}}}
				@endif
				<label for="username">Username</label>
				<input type="text" name="username" id="username">
			</div>
			<div class="form-group">
				@if($errors->has('email'))
					{{{$errors->first('email')}}}
				@endif
				<label for="email">Email</label>
				<input type="text" name="email" id="email">
			</div>
			<div class="form-group">
				@if($errors->has('gender'))
					{{{$errors->first('gender')}}}
				@endif
				<label for="gender">Which gender do you most strongly identify as?</label>
				<label><input type="radio" name="gender" value="Male">Male</label>
				<label><input type="radio" name="gender" value="Female">Female</label>
			</div>
			<div class="form-group">
				@if($errors->has('ethnicity'))
					{{{$errors->first('ethnicity')}}}
				@endif
				<label for="ethnicity">Ethnicity</label>
				<label><input type="radio" name="ethnicity" value="Caucasian">Caucasian</label>
				<label><input type="radio" name="ethnicity"value="Black">African American</label>
				<label><input type="radio" name="ethnicity"value="Hispanic">Hispanic</label> 
				<label><input type="radio" name="ethnicity"value="Asian">Asian</label>
				<label><input type="radio" name="ethnicity"value="Mixed">Mixed</label>
				<label><input type="radio" name="ethnicity"value="Other">Other</label>
			</div>
			<div class="form-group">
				@if($errors->has('preference'))
					{{{$errors->first('preference')}}}
				@endif
				<label for="preference">I am looking for someone who is: </label>
				<label><input type="radio" name="preference" id="preference1" value="Female">Female</label>
				<label><input type="radio" name="preference" id="preference2" value="Male">Male</label>
				<label><input type="radio" name="preference" id="preference3" value="All">Either Male or Female</label>
			</div>
			<div class="form-group">
				@if($errors->has('day'))
					{{{$errors->first('day')}}}
				@endif
				@if($errors->has('month'))
					{{{$errors->first('month')}}}
				@endif
				@if($errors->has('year'))
					{{{$errors->first('year')}}}
				@endif
				<label for="birthday">Birthday</label>
				<select name="month">
					<option disabled> - Month - </option>
					<option value="January">January</option>
					<option value="Febuary">Febuary</option>
					<option value="March">March</option>
					<option value="April">April</option>
					<option value="May">May</option>
					<option value="June">June</option>
					<option value="July">July</option>
					<option value="August">August</option>
					<option value="September">September</option>
					<option value="October">October</option>
					<option value="November">November</option>
					<option value="December">December</option>
				</select>

				<select name="day">
					<option disabled> - Day - </option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
				</select>

				<select name="year">
					<option disabled> - Year - </option>
					<option value="1998">1998</option>
					<option value="1997">1997</option>
					<option value="1996">1996</option>
					<option value="1995">1995</option>
					<option value="1994">1994</option>
					<option value="1993">1993</option>
					<option value="1992">1992</option>
					<option value="1991">1991</option>
					<option value="1990">1990</option>
					<option value="1989">1989</option>
					<option value="1988">1988</option>
					<option value="1987">1987</option>
					<option value="1986">1986</option>
					<option value="1985">1985</option>
					<option value="1984">1984</option>
					<option value="1983">1983</option>
					<option value="1982">1982</option>
					<option value="1981">1981</option>
					<option value="1980">1980</option>
					<option value="1979">1979</option>
					<option value="1978">1978</option>
					<option value="1977">1977</option>
					<option value="1976">1976</option>
					<option value="1975">1975</option>
					<option value="1974">1974</option>
					<option value="1973">1973</option>
					<option value="1972">1972</option>
					<option value="1971">1971</option>
					<option value="1970">1970</option>
					<option value="1969">1969</option>
					<option value="1968">1968</option>
					<option value="1967">1967</option>
					<option value="1966">1966</option>
					<option value="1965">1965</option>
					<option value="1964">1964</option>
					<option value="1963">1963</option>
					<option value="1962">1962</option>
					<option value="1961">1961</option>
					<option value="1960">1960</option>
					<option value="1959">1959</option>
					<option value="1958">1958</option>
					<option value="1957">1957</option>
					<option value="1956">1956</option>
					<option value="1955">1955</option>
					<option value="1954">1954</option>
					<option value="1953">1953</option>
					<option value="1952">1952</option>
					<option value="1951">1951</option>
					<option value="1950">1950</option>
					<option value="1949">1949</option>
					<option value="1948">1948</option>
					<option value="1947">1947</option>
					
				</select>
			</div>
			<div class="form-group">
				@if($errors->has('state'))
					{{{$errors->first('state')}}}
				@endif
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
				@if($errors->has('city'))
					{{{$errors->first('city')}}}
				@endif
				<label for="city">City</label>
				<input type="text" name="city" id="city">
			</div>
			<div class="form-group">
				@if($errors->has('zipcode'))
					{{{$errors->first('zipcode')}}}
				@endif
				<label for="zipcode">Zip</label>
				<input type="number" name="zipcode" id="zipcode">
			</div>
			<div class="form-group">
				<label for="willing">Are you looking to Hookup?</label>
				<label><input type="radio" name="willing" value="Yes">Yes</label>
				<label><input type="radio" name="willing" value="No">No</label>
			</div>
			<div class="form-group">
				@if($errors->has('password'))
					{{{$errors->first('password')}}}
				@endif
				<label for="password">Password</label>
				<input type="password" name="password" id="password">
			</div>
			<div class="form-group">
				<label for="password_confirmation">Confirm Password</label>
				<input type="password" name="password_confirmation" id="password_confirmation">
			</div>
			<h3>Important!</h3>
			<h4>We do not ask for your credit card information, because we want our users to feel secure in using our site. However, the tradeoff for this is that your IP address, browser, and machine type is logged every time you log in. If you are found to be engaging in anything illegal, all of the information logged at the time of the offense will be turned over without hesitation. No solicitation of minors or financial transactions for services will be tolerated.</h4>
			<label for="contract">I Understand</label>
			<input type="checkbox" name="contract" id="contract">
			<div class="form-group">
				<button class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>
@stop