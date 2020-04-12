CREATE DATABASE IF NOT EXISTS tpm;

ALTER DATABASE tpm CHARACTER SET utf8 COLLATE utf8_general_ci;

USE tpm;

/*

	Creating all database tables

*/

CREATE TABLE IF NOT EXISTS merchants (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

    name TINYTEXT NOT NULL,

    global_discount FLOAT(3, 3) DEFAULT NULL,

    shipping_country VARCHAR(3) NOT NULL /* Country Codes (ISO 3166 Alpha-3) */
);

CREATE TABLE IF NOT EXISTS accounts (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

    username VARCHAR(128) NOT NULL UNIQUE KEY,
    email VARCHAR(128) NOT NULL UNIQUE KEY,

    password VARCHAR(1024) NOT NULL,

    name_first VARCHAR(64),
    name_last VARCHAR(64),

    name_full VARCHAR(128) GENERATED ALWAYS AS (CONCAT(name_first, ' ', name_last)),

    addressing JSON, /* JSON Object with billing and shipping address(es) */

    merchant_account BOOLEAN DEFAULT 0, /* Whether or not this account is a merchant account */
    merchant_id INT UNSIGNED,

    FOREIGN KEY (merchant_id) REFERENCES merchants(id)
);

CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    upc INT(12) ZEROFILL DEFAULT NULL UNIQUE KEY,

    merchant_id INT NOT NULL,

    name TINYTEXT NOT NULL,
    description TEXT NOT NULL,
 
 	resources TINYTEXT GENERATED ALWAYS AS (CONCAT("./res/images/", id, "/")) STORED NOT NULL,
    
	units_available INT NOT NULL DEFAULT 0,
    unit_weight FLOAT(3, 1),
	
	unit_price FLOAT(6, 2) NOT NULL,
    unit_discount FLOAT(3, 3) DEFAULT NULL,

    shipping_method_highest TINYINT UNSIGNED DEFAULT NULL,

    FOREIGN KEY (merchant_id) REFERENCES merchants(id)
);

CREATE TABLE IF NOT EXISTS orders (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

    account_id INT UNSIGNED NOT NULL, 

    products_ordered JSON NOT NULL, /* JSON Object with products ordered */
    addressing JSON NOT NULL, /* JSON Object with billing and shipping address(es) */

    status ENUM("Completed", "En Route", "Packaging", "Payment Accepted", "Payment Processing", "Payment Rejected", "Cancelled") NOT NULL DEFAULT "Payment Processing",

    FOREIGN KEY (account_id) REFERENCES accounts(id)
);

CREATE TABLE IF NOT EXISTS iso_countrycodes (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE KEY,
	alpha2 VARCHAR(2) NOT NULL UNIQUE KEY,
	alpha3 VARCHAR(3) NOT NULL UNIQUE KEY,
	country_code INT(3) ZEROFILL UNSIGNED UNIQUE KEY,
	iso_3166_2 VARCHAR(13) NOT NULL UNIQUE KEY,
	region ENUM("", "Africa", "Americas", "Asia", "Europe", "Oceania") NOT NULL,
	sub_region VARCHAR(255) NOT NULL DEFAULT "",
	immediate_region VARCHAR(255) NOT NULL DEFAULT "",
	region_code INT(3) ZEROFILL UNSIGNED,
	sub_region_code INT(3) ZEROFILL UNSIGNED,
	immediate_region_code INT(3) ZEROFILL UNSIGNED
);


/*

	Insert ISO-3166 country codes

*/

INSERT INTO iso_countrycodes
	(name, alpha2, alpha3, country_code,
		iso_3166_2, region, sub_region,
		immediate_region, region_code,
		sub_region_code, immediate_region_code)
VALUES
	("Afghanistan","AF","AFG",004,"ISO 3166-2:AF","Asia","Southern Asia","",142,034,NULL),
	("Åland Islands","AX","ALA",248,"ISO 3166-2:AX","Europe","Northern Europe","",150,154,NULL),
	("Albania","AL","ALB",008,"ISO 3166-2:AL","Europe","Southern Europe","",150,039,NULL),
	("Algeria","DZ","DZA",012,"ISO 3166-2:DZ","Africa","Northern Africa","",002,015,NULL),
	("American Samoa","AS","ASM",016,"ISO 3166-2:AS","Oceania","Polynesia","",009,061,NULL),
	("Andorra","AD","AND","020","ISO 3166-2:AD","Europe","Southern Europe","",150,039,NULL),
	("Angola","AO","AGO",024,"ISO 3166-2:AO","Africa","Sub-Saharan Africa","Middle Africa",002,202,017),
	("Anguilla","AI","AIA",660,"ISO 3166-2:AI","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Antarctica","AQ","ATA",010,"ISO 3166-2:AQ","","","",NULL,NULL,NULL),
	("Antigua and Barbuda","AG","ATG",028,"ISO 3166-2:AG","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Argentina","AR","ARG",032,"ISO 3166-2:AR","Americas","Latin America and the Caribbean","South America",019,419,005),
	("Armenia","AM","ARM",051,"ISO 3166-2:AM","Asia","Western Asia","",142,145,NULL),
	("Aruba","AW","ABW",533,"ISO 3166-2:AW","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Australia","AU","AUS",036,"ISO 3166-2:AU","Oceania","Australia and New Zealand","",009,053,NULL),
	("Austria","AT","AUT",040,"ISO 3166-2:AT","Europe","Western Europe","",150,155,NULL),
	("Azerbaijan","AZ","AZE",031,"ISO 3166-2:AZ","Asia","Western Asia","",142,145,NULL),
	("Bahamas","BS","BHS",044,"ISO 3166-2:BS","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Bahrain","BH","BHR",048,"ISO 3166-2:BH","Asia","Western Asia","",142,145,NULL),
	("Bangladesh","BD","BGD",050,"ISO 3166-2:BD","Asia","Southern Asia","",142,034,NULL),
	("Barbados","BB","BRB",052,"ISO 3166-2:BB","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Belarus","BY","BLR",112,"ISO 3166-2:BY","Europe","Eastern Europe","",150,151,NULL),
	("Belgium","BE","BEL",056,"ISO 3166-2:BE","Europe","Western Europe","",150,155,NULL),
	("Belize","BZ","BLZ",084,"ISO 3166-2:BZ","Americas","Latin America and the Caribbean","Central America",019,419,013),
	("Benin","BJ","BEN",204,"ISO 3166-2:BJ","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Bermuda","BM","BMU",060,"ISO 3166-2:BM","Americas","Northern America","",019,021,NULL),
	("Bhutan","BT","BTN",064,"ISO 3166-2:BT","Asia","Southern Asia","",142,034,NULL),
	("Bolivia (Plurinational State of)","BO","BOL",068,"ISO 3166-2:BO","Americas","Latin America and the Caribbean","South America",019,419,005),
	("Bonaire, Sint Eustatius and Saba","BQ","BES",535,"ISO 3166-2:BQ","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Bosnia and Herzegovina","BA","BIH",070,"ISO 3166-2:BA","Europe","Southern Europe","",150,039,NULL),
	("Botswana","BW","BWA",072,"ISO 3166-2:BW","Africa","Sub-Saharan Africa","Southern Africa",002,202,018),
	("Bouvet Island","BV","BVT",074,"ISO 3166-2:BV","Americas","Latin America and the Caribbean","South America",019,419,005),
	("Brazil","BR","BRA",076,"ISO 3166-2:BR","Americas","Latin America and the Caribbean","South America",019,419,005),
	("British Indian Ocean Territory","IO","IOT",086,"ISO 3166-2:IO","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Brunei Darussalam","BN","BRN",096,"ISO 3166-2:BN","Asia","South-eastern Asia","",142,035,NULL),
	("Bulgaria","BG","BGR",100,"ISO 3166-2:BG","Europe","Eastern Europe","",150,151,NULL),
	("Burkina Faso","BF","BFA",854,"ISO 3166-2:BF","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Burundi","BI","BDI",108,"ISO 3166-2:BI","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Cabo Verde","CV","CPV",132,"ISO 3166-2:CV","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Cambodia","KH","KHM",116,"ISO 3166-2:KH","Asia","South-eastern Asia","",142,035,NULL),
	("Cameroon","CM","CMR",120,"ISO 3166-2:CM","Africa","Sub-Saharan Africa","Middle Africa",002,202,017),
	("Canada","CA","CAN",124,"ISO 3166-2:CA","Americas","Northern America","",019,021,NULL),
	("Cayman Islands","KY","CYM",136,"ISO 3166-2:KY","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Central African Republic","CF","CAF",140,"ISO 3166-2:CF","Africa","Sub-Saharan Africa","Middle Africa",002,202,017),
	("Chad","TD","TCD",148,"ISO 3166-2:TD","Africa","Sub-Saharan Africa","Middle Africa",002,202,017),
	("Chile","CL","CHL",152,"ISO 3166-2:CL","Americas","Latin America and the Caribbean","South America",019,419,005),
	("China","CN","CHN",156,"ISO 3166-2:CN","Asia","Eastern Asia","",142,030,NULL),
	("Christmas Island","CX","CXR",162,"ISO 3166-2:CX","Oceania","Australia and New Zealand","",009,053,NULL),
	("Cocos (Keeling) Islands","CC","CCK",166,"ISO 3166-2:CC","Oceania","Australia and New Zealand","",009,053,NULL),
	("Colombia","CO","COL",170,"ISO 3166-2:CO","Americas","Latin America and the Caribbean","South America",019,419,005),
	("Comoros","KM","COM",174,"ISO 3166-2:KM","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Congo","CG","COG",178,"ISO 3166-2:CG","Africa","Sub-Saharan Africa","Middle Africa",002,202,017),
	("Congo, Democratic Republic of the","CD","COD",180,"ISO 3166-2:CD","Africa","Sub-Saharan Africa","Middle Africa",002,202,017),
	("Cook Islands","CK","COK",184,"ISO 3166-2:CK","Oceania","Polynesia","",009,061,NULL),
	("Costa Rica","CR","CRI",188,"ISO 3166-2:CR","Americas","Latin America and the Caribbean","Central America",019,419,013),
	("Côte d'Ivoire","CI","CIV",384,"ISO 3166-2:CI","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Croatia","HR","HRV",191,"ISO 3166-2:HR","Europe","Southern Europe","",150,039,NULL),
	("Cuba","CU","CUB",192,"ISO 3166-2:CU","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Curaçao","CW","CUW",531,"ISO 3166-2:CW","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Cyprus","CY","CYP",196,"ISO 3166-2:CY","Asia","Western Asia","",142,145,NULL),
	("Czechia","CZ","CZE",203,"ISO 3166-2:CZ","Europe","Eastern Europe","",150,151,NULL),
	("Denmark","DK","DNK",208,"ISO 3166-2:DK","Europe","Northern Europe","",150,154,NULL),
	("Djibouti","DJ","DJI",262,"ISO 3166-2:DJ","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Dominica","DM","DMA",212,"ISO 3166-2:DM","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Dominican Republic","DO","DOM",214,"ISO 3166-2:DO","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Ecuador","EC","ECU",218,"ISO 3166-2:EC","Americas","Latin America and the Caribbean","South America",019,419,005),
	("Egypt","EG","EGY",818,"ISO 3166-2:EG","Africa","Northern Africa","",002,015,NULL),
	("El Salvador","SV","SLV",222,"ISO 3166-2:SV","Americas","Latin America and the Caribbean","Central America",019,419,013),
	("Equatorial Guinea","GQ","GNQ",226,"ISO 3166-2:GQ","Africa","Sub-Saharan Africa","Middle Africa",002,202,017),
	("Eritrea","ER","ERI",232,"ISO 3166-2:ER","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Estonia","EE","EST",233,"ISO 3166-2:EE","Europe","Northern Europe","",150,154,NULL),
	("Eswatini","SZ","SWZ",748,"ISO 3166-2:SZ","Africa","Sub-Saharan Africa","Southern Africa",002,202,018),
	("Ethiopia","ET","ETH",231,"ISO 3166-2:ET","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Falkland Islands (Malvinas)","FK","FLK",238,"ISO 3166-2:FK","Americas","Latin America and the Caribbean","South America",019,419,005),
	("Faroe Islands","FO","FRO",234,"ISO 3166-2:FO","Europe","Northern Europe","",150,154,NULL),
	("Fiji","FJ","FJI",242,"ISO 3166-2:FJ","Oceania","Melanesia","",009,054,NULL),
	("Finland","FI","FIN",246,"ISO 3166-2:FI","Europe","Northern Europe","",150,154,NULL),
	("France","FR","FRA",250,"ISO 3166-2:FR","Europe","Western Europe","",150,155,NULL),
	("French Guiana","GF","GUF",254,"ISO 3166-2:GF","Americas","Latin America and the Caribbean","South America",019,419,005),
	("French Polynesia","PF","PYF",258,"ISO 3166-2:PF","Oceania","Polynesia","",009,061,NULL),
	("French Southern Territories","TF","ATF",260,"ISO 3166-2:TF","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Gabon","GA","GAB",266,"ISO 3166-2:GA","Africa","Sub-Saharan Africa","Middle Africa",002,202,017),
	("Gambia","GM","GMB",270,"ISO 3166-2:GM","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Georgia","GE","GEO",268,"ISO 3166-2:GE","Asia","Western Asia","",142,145,NULL),
	("Germany","DE","DEU",276,"ISO 3166-2:DE","Europe","Western Europe","",150,155,NULL),
	("Ghana","GH","GHA",288,"ISO 3166-2:GH","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Gibraltar","GI","GIB",292,"ISO 3166-2:GI","Europe","Southern Europe","",150,039,NULL),
	("Greece","GR","GRC",300,"ISO 3166-2:GR","Europe","Southern Europe","",150,039,NULL),
	("Greenland","GL","GRL",304,"ISO 3166-2:GL","Americas","Northern America","",019,021,NULL),
	("Grenada","GD","GRD",308,"ISO 3166-2:GD","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Guadeloupe","GP","GLP",312,"ISO 3166-2:GP","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Guam","GU","GUM",316,"ISO 3166-2:GU","Oceania","Micronesia","",009,057,NULL),
	("Guatemala","GT","GTM",320,"ISO 3166-2:GT","Americas","Latin America and the Caribbean","Central America",019,419,013),
	("Guernsey","GG","GGY",831,"ISO 3166-2:GG","Europe","Northern Europe","Channel Islands",150,154,830),
	("Guinea","GN","GIN",324,"ISO 3166-2:GN","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Guinea-Bissau","GW","GNB",624,"ISO 3166-2:GW","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Guyana","GY","GUY",328,"ISO 3166-2:GY","Americas","Latin America and the Caribbean","South America",019,419,005),
	("Haiti","HT","HTI",332,"ISO 3166-2:HT","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Heard Island and McDonald Islands","HM","HMD",334,"ISO 3166-2:HM","Oceania","Australia and New Zealand","",009,053,NULL),
	("Holy See","VA","VAT",336,"ISO 3166-2:VA","Europe","Southern Europe","",150,039,NULL),
	("Honduras","HN","HND",340,"ISO 3166-2:HN","Americas","Latin America and the Caribbean","Central America",019,419,013),
	("Hong Kong","HK","HKG",344,"ISO 3166-2:HK","Asia","Eastern Asia","",142,030,NULL),
	("Hungary","HU","HUN",348,"ISO 3166-2:HU","Europe","Eastern Europe","",150,151,NULL),
	("Iceland","IS","ISL",352,"ISO 3166-2:IS","Europe","Northern Europe","",150,154,NULL),
	("India","IN","IND",356,"ISO 3166-2:IN","Asia","Southern Asia","",142,034,NULL),
	("Indonesia","ID","IDN",360,"ISO 3166-2:ID","Asia","South-eastern Asia","",142,035,NULL),
	("Iran (Islamic Republic of)","IR","IRN",364,"ISO 3166-2:IR","Asia","Southern Asia","",142,034,NULL),
	("Iraq","IQ","IRQ",368,"ISO 3166-2:IQ","Asia","Western Asia","",142,145,NULL),
	("Ireland","IE","IRL",372,"ISO 3166-2:IE","Europe","Northern Europe","",150,154,NULL),
	("Isle of Man","IM","IMN",833,"ISO 3166-2:IM","Europe","Northern Europe","",150,154,NULL),
	("Israel","IL","ISR",376,"ISO 3166-2:IL","Asia","Western Asia","",142,145,NULL),
	("Italy","IT","ITA",380,"ISO 3166-2:IT","Europe","Southern Europe","",150,039,NULL),
	("Jamaica","JM","JAM",388,"ISO 3166-2:JM","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Japan","JP","JPN",392,"ISO 3166-2:JP","Asia","Eastern Asia","",142,030,NULL),
	("Jersey","JE","JEY",832,"ISO 3166-2:JE","Europe","Northern Europe","Channel Islands",150,154,830),
	("Jordan","JO","JOR",400,"ISO 3166-2:JO","Asia","Western Asia","",142,145,NULL),
	("Kazakhstan","KZ","KAZ",398,"ISO 3166-2:KZ","Asia","Central Asia","",142,143,NULL),
	("Kenya","KE","KEN",404,"ISO 3166-2:KE","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Kiribati","KI","KIR",296,"ISO 3166-2:KI","Oceania","Micronesia","",009,057,NULL),
	("Korea (Democratic People's Republic of)","KP","PRK",408,"ISO 3166-2:KP","Asia","Eastern Asia","",142,030,NULL),
	("Korea, Republic of","KR","KOR",410,"ISO 3166-2:KR","Asia","Eastern Asia","",142,030,NULL),
	("Kuwait","KW","KWT",414,"ISO 3166-2:KW","Asia","Western Asia","",142,145,NULL),
	("Kyrgyzstan","KG","KGZ",417,"ISO 3166-2:KG","Asia","Central Asia","",142,143,NULL),
	("Lao People's Democratic Republic","LA","LAO",418,"ISO 3166-2:LA","Asia","South-eastern Asia","",142,035,NULL),
	("Latvia","LV","LVA",428,"ISO 3166-2:LV","Europe","Northern Europe","",150,154,NULL),
	("Lebanon","LB","LBN",422,"ISO 3166-2:LB","Asia","Western Asia","",142,145,NULL),
	("Lesotho","LS","LSO",426,"ISO 3166-2:LS","Africa","Sub-Saharan Africa","Southern Africa",002,202,018),
	("Liberia","LR","LBR",430,"ISO 3166-2:LR","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Libya","LY","LBY",434,"ISO 3166-2:LY","Africa","Northern Africa","",002,015,NULL),
	("Liechtenstein","LI","LIE",438,"ISO 3166-2:LI","Europe","Western Europe","",150,155,NULL),
	("Lithuania","LT","LTU",440,"ISO 3166-2:LT","Europe","Northern Europe","",150,154,NULL),
	("Luxembourg","LU","LUX",442,"ISO 3166-2:LU","Europe","Western Europe","",150,155,NULL),
	("Macao","MO","MAC",446,"ISO 3166-2:MO","Asia","Eastern Asia","",142,030,NULL),
	("Madagascar","MG","MDG",450,"ISO 3166-2:MG","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Malawi","MW","MWI",454,"ISO 3166-2:MW","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Malaysia","MY","MYS",458,"ISO 3166-2:MY","Asia","South-eastern Asia","",142,035,NULL),
	("Maldives","MV","MDV",462,"ISO 3166-2:MV","Asia","Southern Asia","",142,034,NULL),
	("Mali","ML","MLI",466,"ISO 3166-2:ML","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Malta","MT","MLT",470,"ISO 3166-2:MT","Europe","Southern Europe","",150,039,NULL),
	("Marshall Islands","MH","MHL",584,"ISO 3166-2:MH","Oceania","Micronesia","",009,057,NULL),
	("Martinique","MQ","MTQ",474,"ISO 3166-2:MQ","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Mauritania","MR","MRT",478,"ISO 3166-2:MR","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Mauritius","MU","MUS",480,"ISO 3166-2:MU","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Mayotte","YT","MYT",175,"ISO 3166-2:YT","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Mexico","MX","MEX",484,"ISO 3166-2:MX","Americas","Latin America and the Caribbean","Central America",019,419,013),
	("Micronesia (Federated States of)","FM","FSM",583,"ISO 3166-2:FM","Oceania","Micronesia","",009,057,NULL),
	("Moldova, Republic of","MD","MDA",498,"ISO 3166-2:MD","Europe","Eastern Europe","",150,151,NULL),
	("Monaco","MC","MCO",492,"ISO 3166-2:MC","Europe","Western Europe","",150,155,NULL),
	("Mongolia","MN","MNG",496,"ISO 3166-2:MN","Asia","Eastern Asia","",142,030,NULL),
	("Montenegro","ME","MNE",499,"ISO 3166-2:ME","Europe","Southern Europe","",150,039,NULL),
	("Montserrat","MS","MSR",500,"ISO 3166-2:MS","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Morocco","MA","MAR",504,"ISO 3166-2:MA","Africa","Northern Africa","",002,015,NULL),
	("Mozambique","MZ","MOZ",508,"ISO 3166-2:MZ","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Myanmar","MM","MMR",104,"ISO 3166-2:MM","Asia","South-eastern Asia","",142,035,NULL),
	("Namibia","NA","NAM",516,"ISO 3166-2:NA","Africa","Sub-Saharan Africa","Southern Africa",002,202,018),
	("Nauru","NR","NRU",520,"ISO 3166-2:NR","Oceania","Micronesia","",009,057,NULL),
	("Nepal","NP","NPL",524,"ISO 3166-2:NP","Asia","Southern Asia","",142,034,NULL),
	("Netherlands","NL","NLD",528,"ISO 3166-2:NL","Europe","Western Europe","",150,155,NULL),
	("New Caledonia","NC","NCL",540,"ISO 3166-2:NC","Oceania","Melanesia","",009,054,NULL),
	("New Zealand","NZ","NZL",554,"ISO 3166-2:NZ","Oceania","Australia and New Zealand","",009,053,NULL),
	("Nicaragua","NI","NIC",558,"ISO 3166-2:NI","Americas","Latin America and the Caribbean","Central America",019,419,013),
	("Niger","NE","NER",562,"ISO 3166-2:NE","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Nigeria","NG","NGA",566,"ISO 3166-2:NG","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Niue","NU","NIU",570,"ISO 3166-2:NU","Oceania","Polynesia","",009,061,NULL),
	("Norfolk Island","NF","NFK",574,"ISO 3166-2:NF","Oceania","Australia and New Zealand","",009,053,NULL),
	("North Macedonia","MK","MKD",807,"ISO 3166-2:MK","Europe","Southern Europe","",150,039,NULL),
	("Northern Mariana Islands","MP","MNP",580,"ISO 3166-2:MP","Oceania","Micronesia","",009,057,NULL),
	("Norway","NO","NOR",578,"ISO 3166-2:NO","Europe","Northern Europe","",150,154,NULL),
	("Oman","OM","OMN",512,"ISO 3166-2:OM","Asia","Western Asia","",142,145,NULL),
	("Pakistan","PK","PAK",586,"ISO 3166-2:PK","Asia","Southern Asia","",142,034,NULL),
	("Palau","PW","PLW",585,"ISO 3166-2:PW","Oceania","Micronesia","",009,057,NULL),
	("Palestine, State of","PS","PSE",275,"ISO 3166-2:PS","Asia","Western Asia","",142,145,NULL),
	("Panama","PA","PAN",591,"ISO 3166-2:PA","Americas","Latin America and the Caribbean","Central America",019,419,013),
	("Papua New Guinea","PG","PNG",598,"ISO 3166-2:PG","Oceania","Melanesia","",009,054,NULL),
	("Paraguay","PY","PRY",600,"ISO 3166-2:PY","Americas","Latin America and the Caribbean","South America",019,419,005),
	("Peru","PE","PER",604,"ISO 3166-2:PE","Americas","Latin America and the Caribbean","South America",019,419,005),
	("Philippines","PH","PHL",608,"ISO 3166-2:PH","Asia","South-eastern Asia","",142,035,NULL),
	("Pitcairn","PN","PCN",612,"ISO 3166-2:PN","Oceania","Polynesia","",009,061,NULL),
	("Poland","PL","POL",616,"ISO 3166-2:PL","Europe","Eastern Europe","",150,151,NULL),
	("Portugal","PT","PRT",620,"ISO 3166-2:PT","Europe","Southern Europe","",150,039,NULL),
	("Puerto Rico","PR","PRI",630,"ISO 3166-2:PR","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Qatar","QA","QAT",634,"ISO 3166-2:QA","Asia","Western Asia","",142,145,NULL),
	("Réunion","RE","REU",638,"ISO 3166-2:RE","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Romania","RO","ROU",642,"ISO 3166-2:RO","Europe","Eastern Europe","",150,151,NULL),
	("Russian Federation","RU","RUS",643,"ISO 3166-2:RU","Europe","Eastern Europe","",150,151,NULL),
	("Rwanda","RW","RWA",646,"ISO 3166-2:RW","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Saint Barthélemy","BL","BLM",652,"ISO 3166-2:BL","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Saint Helena, Ascension and Tristan da Cunha","SH","SHN",654,"ISO 3166-2:SH","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Saint Kitts and Nevis","KN","KNA",659,"ISO 3166-2:KN","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Saint Lucia","LC","LCA",662,"ISO 3166-2:LC","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Saint Martin (French part)","MF","MAF",663,"ISO 3166-2:MF","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Saint Pierre and Miquelon","PM","SPM",666,"ISO 3166-2:PM","Americas","Northern America","",019,021,NULL),
	("Saint Vincent and the Grenadines","VC","VCT",670,"ISO 3166-2:VC","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Samoa","WS","WSM",882,"ISO 3166-2:WS","Oceania","Polynesia","",009,061,NULL),
	("San Marino","SM","SMR",674,"ISO 3166-2:SM","Europe","Southern Europe","",150,039,NULL),
	("Sao Tome and Principe","ST","STP",678,"ISO 3166-2:ST","Africa","Sub-Saharan Africa","Middle Africa",002,202,017),
	("Saudi Arabia","SA","SAU",682,"ISO 3166-2:SA","Asia","Western Asia","",142,145,NULL),
	("Senegal","SN","SEN",686,"ISO 3166-2:SN","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Serbia","RS","SRB",688,"ISO 3166-2:RS","Europe","Southern Europe","",150,039,NULL),
	("Seychelles","SC","SYC",690,"ISO 3166-2:SC","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Sierra Leone","SL","SLE",694,"ISO 3166-2:SL","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Singapore","SG","SGP",702,"ISO 3166-2:SG","Asia","South-eastern Asia","",142,035,NULL),
	("Sint Maarten (Dutch part)","SX","SXM",534,"ISO 3166-2:SX","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Slovakia","SK","SVK",703,"ISO 3166-2:SK","Europe","Eastern Europe","",150,151,NULL),
	("Slovenia","SI","SVN",705,"ISO 3166-2:SI","Europe","Southern Europe","",150,039,NULL),
	("Solomon Islands","SB","SLB",090,"ISO 3166-2:SB","Oceania","Melanesia","",009,054,NULL),
	("Somalia","SO","SOM",706,"ISO 3166-2:SO","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("South Africa","ZA","ZAF",710,"ISO 3166-2:ZA","Africa","Sub-Saharan Africa","Southern Africa",002,202,018),
	("South Georgia and the South Sandwich Islands","GS","SGS",239,"ISO 3166-2:GS","Americas","Latin America and the Caribbean","South America",019,419,005),
	("South Sudan","SS","SSD",728,"ISO 3166-2:SS","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Spain","ES","ESP",724,"ISO 3166-2:ES","Europe","Southern Europe","",150,039,NULL),
	("Sri Lanka","LK","LKA",144,"ISO 3166-2:LK","Asia","Southern Asia","",142,034,NULL),
	("Sudan","SD","SDN",729,"ISO 3166-2:SD","Africa","Northern Africa","",002,015,NULL),
	("Suriname","SR","SUR",740,"ISO 3166-2:SR","Americas","Latin America and the Caribbean","South America",019,419,005),
	("Svalbard and Jan Mayen","SJ","SJM",744,"ISO 3166-2:SJ","Europe","Northern Europe","",150,154,NULL),
	("Sweden","SE","SWE",752,"ISO 3166-2:SE","Europe","Northern Europe","",150,154,NULL),
	("Switzerland","CH","CHE",756,"ISO 3166-2:CH","Europe","Western Europe","",150,155,NULL),
	("Syrian Arab Republic","SY","SYR",760,"ISO 3166-2:SY","Asia","Western Asia","",142,145,NULL),
	("Taiwan, Province of China","TW","TWN",158,"ISO 3166-2:TW","Asia","Eastern Asia","",142,030,NULL),
	("Tajikistan","TJ","TJK",762,"ISO 3166-2:TJ","Asia","Central Asia","",142,143,NULL),
	("Tanzania, United Republic of","TZ","TZA",834,"ISO 3166-2:TZ","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Thailand","TH","THA",764,"ISO 3166-2:TH","Asia","South-eastern Asia","",142,035,NULL),
	("Timor-Leste","TL","TLS",626,"ISO 3166-2:TL","Asia","South-eastern Asia","",142,035,NULL),
	("Togo","TG","TGO",768,"ISO 3166-2:TG","Africa","Sub-Saharan Africa","Western Africa",002,202,011),
	("Tokelau","TK","TKL",772,"ISO 3166-2:TK","Oceania","Polynesia","",009,061,NULL),
	("Tonga","TO","TON",776,"ISO 3166-2:TO","Oceania","Polynesia","",009,061,NULL),
	("Trinidad and Tobago","TT","TTO",780,"ISO 3166-2:TT","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Tunisia","TN","TUN",788,"ISO 3166-2:TN","Africa","Northern Africa","",002,015,NULL),
	("Turkey","TR","TUR",792,"ISO 3166-2:TR","Asia","Western Asia","",142,145,NULL),
	("Turkmenistan","TM","TKM",795,"ISO 3166-2:TM","Asia","Central Asia","",142,143,NULL),
	("Turks and Caicos Islands","TC","TCA",796,"ISO 3166-2:TC","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Tuvalu","TV","TUV",798,"ISO 3166-2:TV","Oceania","Polynesia","",009,061,NULL),
	("Uganda","UG","UGA",800,"ISO 3166-2:UG","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Ukraine","UA","UKR",804,"ISO 3166-2:UA","Europe","Eastern Europe","",150,151,NULL),
	("United Arab Emirates","AE","ARE",784,"ISO 3166-2:AE","Asia","Western Asia","",142,145,NULL),
	("United Kingdom of Great Britain and Northern Ireland","GB","GBR",826,"ISO 3166-2:GB","Europe","Northern Europe","",150,154,NULL),
	("United States of America","US","USA",840,"ISO 3166-2:US","Americas","Northern America","",019,021,NULL),
	("United States Minor Outlying Islands","UM","UMI",581,"ISO 3166-2:UM","Oceania","Micronesia","",009,057,NULL),
	("Uruguay","UY","URY",858,"ISO 3166-2:UY","Americas","Latin America and the Caribbean","South America",019,419,005),
	("Uzbekistan","UZ","UZB",860,"ISO 3166-2:UZ","Asia","Central Asia","",142,143,NULL),
	("Vanuatu","VU","VUT",548,"ISO 3166-2:VU","Oceania","Melanesia","",009,054,NULL),
	("Venezuela (Bolivarian Republic of)","VE","VEN",862,"ISO 3166-2:VE","Americas","Latin America and the Caribbean","South America",019,419,005),
	("Viet Nam","VN","VNM",704,"ISO 3166-2:VN","Asia","South-eastern Asia","",142,035,NULL),
	("Virgin Islands (British)","VG","VGB",092,"ISO 3166-2:VG","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Virgin Islands (U.S.)","VI","VIR",850,"ISO 3166-2:VI","Americas","Latin America and the Caribbean","Caribbean",019,419,029),
	("Wallis and Futuna","WF","WLF",876,"ISO 3166-2:WF","Oceania","Polynesia","",009,061,NULL),
	("Western Sahara","EH","ESH",732,"ISO 3166-2:EH","Africa","Northern Africa","",002,015,NULL),
	("Yemen","YE","YEM",887,"ISO 3166-2:YE","Asia","Western Asia","",142,145,NULL),
	("Zambia","ZM","ZMB",894,"ISO 3166-2:ZM","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014),
	("Zimbabwe","ZW","ZWE",716,"ISO 3166-2:ZW","Africa","Sub-Saharan Africa","Eastern Africa",002,202,014)
		