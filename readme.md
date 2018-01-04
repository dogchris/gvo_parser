# command list

cd Command

php download.php 'http://gvo.cbo.com.tw/Adv_Discover.aspx?Type=1' > ../Source/DiscoveryList/1.html

php getDiscoveryList.php 

php download.php 'http://gvo.cbo.com.tw/Adv_Mission.aspx?city=2&Kind=0' > ../Source/QuestList/2.html

php getQuestList.php

php download.php 'http://gvo.cbo.com.tw/Adv_Library.aspx?city=2' > ../Source/MapList/2.html

php getMapList.php

php download.php 'http://gvo.cbo.com.tw/Adv_Fish.aspx' > ../Source/FishList/fish.html

php initCity.php
