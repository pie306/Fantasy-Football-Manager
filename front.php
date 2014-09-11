<html>
	<form action="addPlayer.php" method="POST">
		<select name="position">
			<option value="">Position</option>
			<option value="QB">QuarterBack</option>
			<option value="RB">RunningBack</option>
			<option value="WR">Wide Receiver</option>
			<option value="TE">Tight End</option>
			<option value="K">Kicker</option>
			<option value="Def">Defense</option>
		</select>
		<br>
		Player Name: <input type="text" name="playerName" value="">
		<br>
		<button type="submit">Add Player</button>
		<br>
	</form>
</html>
