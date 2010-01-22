<?php

   echo"
        <div class=\"hlavicka\">
				<div class=\"menu_top\">
				<ul id=\"top\">
					<li><a class=\"link01\" href=".$files["showTeams"].">Týmy</a>
					<ul class=\"submenu_top type02\">
							<li><a class=\"active podkat\" href=".$files["addTeam"].">Pridat tým</a></li>
							<li><a class=\"podkat\" href=".$files["editTeamN"].">Editovat tým</a></li>
						</ul>
					</li>
					<li><a class=\"link01\" href=".$files["showPlayers"].">Hráèi</a>
					<ul class=\"submenu_top type02\">
							<li><a class=\"active podkat\" href=".$files["addPlayer"].">Pridat hráèe</a></li>
							<li><a class=\"podkat\" href=".$files["editPlayerN"].">Editovat hráèe</a></li>
						</ul>
					</li>
					<li><a class=\"link01\" href=\"#\">Skupiny</a>
						<ul class=\"submenu_top type02\">
							<li><a class=\"podkat\" href=".$files["showA"].">Skupina A</a></li>
							<li><a class=\"podkat\" href=".$files["showB"].">Skupina B</a></li>
							<li><a class=\"podkat\" href=".$files["showC"].">Skupina C</a></li>
							<li><a class=\"podkat\" href=".$files["showD"].">Skupina D</a></li>
							<li><a class=\"podkat\" href=".$files["showE"].">Skupina E</a></li>
							<li><a class=\"podkat\" href=".$files["showF"].">Skupina F</a></li>
							<li><a class=\"podkat\" href=".$files["showG"].">Skupina G</a></li>
							<li><a class=\"podkat\" href=".$files["showH"].">Skupina H</a></li>
						</ul>
					</li>
					<li><a class=\"link01\" href=".$files["showReferees"].">Rozhodèí</a>
						<ul class=\"submenu_top type02\">
							<li><a class=\"active podkat\" href=".$files["addReferee"].">Pridat rozhodèí</a></li>
							<li><a class=\"podkat\" href=".$files["editRefereeN"].">Editovat rozhodèí</a></li>
						</ul>
					</li>
					<li><a class=\"link01\" href=".$files["showActions"].">Akce</a>
						<ul class=\"submenu_top type02\">
							<li><a class=\"active podkat\" href=".$files["addAction"].">Pridat akci</a></li>
							<li><a class=\"podkat\" href=".$files["editAction"].">Editovat akci</a></li>
						</ul>
					</li>
					<li><a class=\"link01\" href=".$files["showMatch"].">Zápasy</a>
						<ul class=\"submenu_top type02\">
							<li><a class=\"active podkat\" href=".$files["addMatch"].">Pridat zápas</a></li>
							<li><a class=\"podkat\" href=".$files["editMatch"].">Editovat zápas</a></li>
						</ul>
					</li>
					<li><a class=\"link01\" href=\"#\">Statistika</a>
						<ul class=\"submenu_top type02\">
							<li><a class=\"podkat\" href=\"#\">Nejlep¹í strelci</a></li>
							<li><a class=\"podkat\" href=\"#\">Nejvíc karet</a></li>
						</ul>
					</li>
					<li><a class=\"link01\" href=\"#\">Data</a>
					<ul class=\"submenu_top type02\">
							<li><a class=\"active podkat\" href=".$files["import"].">Import</a></li>
							<li><a class=\"podkat\" href=".$files["export"].">Export</a></li>
						</ul>
					</li>

					<li><a class=\"link01\" href=".$files["showEscort"].">Doprovodní tým</a>
					<ul class=\"submenu_top type02\">
							<li><a class=\"active podkat\" href=".$files["addEscort"].">Pridat doprovodní tým</a></li>
							<li><a class=\"podkat\" href=".$files["editEscortN"].">Editovat doprovodní tým</a></li>
						</ul>
					</li>
					<li><a class=\"link01\" href=".$files["addUser"].">Registrovat</a></li>
					<li><a class=\"link01\" href=".$files["logout"].">Log out</a></li>
				</ul>
				</div>
			</div>
		</div>
    </br>
    </br>
    </br>";

   echo"
         </body>

      </html>";
?>
