/* Tags to skip on search Titles */ var notUsableTitles = ["surname", "redirects", "disambiguation", "may refer to:", "(genre)", "list of","List of", "lists of","Lists of", "(viral", "filmography", "discography", "videography", "legal disputes", "religious debates", "controversy over", "fandom", "-related", "'s health", "'s appearance", "award", "awards", "(franchise)", "(film series)"]; /* Tags to skip on search Descriptions */ var notUsableDescriptions = ["redirects", "disambiguation", "may refer to:", "bible"];

/* Tags by category */
var music = [

	/*======================================================================= 
		Movies 
	=========================================================================*/

		/* Movies */
		[/(.*)(?:is|was|were|are)(.*)(.*)(?:film(.*)directed|film(.*)produced|superhero film|documentary–concert film|film(.*)originally|film(.*)and|film(.*)created|film(.*)released|film(.*)about|film(.*)with)/, 'movies/television', 'movie_page'],
		[/(.*)(?:is|was|were|are)(.*)(.*)(?:sitcom(.*)created|web television|television(.*)series|television(.*)drama|television sitcom|series(.*)created|sitcom(.*)created|aired on|mockumentary|documentary)/, 'movies/television', 'series_page'],

		/* People */
		[/(.*)(?:is|was|were|are)(.*)(.*)(?:actor|actress|director|producer|writer|character|protagonist(.*)film)/, 'movies/television', 'artist_page'],


	/*======================================================================= 
		Music 
	=========================================================================*/

		/* Artist/Bands/Groups */

		[/(.*)(?:is|was|were|are)(.*)rock band /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)pop band /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)pop\/rock band /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)boy band /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)metal band /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)jazz band /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)britpop\/powerpop /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)music group /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)vocal group /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)hip hop group /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)music duo /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)reggae band /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)pop (.*) group /, 'music', 'artist_page'],

		[/(.*)(?:is|was|were|are)(.*)singer /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)music producer /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)dj /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)dancer /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)musician /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)choreographer /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)recording artist /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)arranger /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)music composer /, 'music', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)rapper /, 'music', 'artist_page'],
		
		/* Album */
		[/(.*)(?:is|was|were|are)(.*)studio album (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)live album (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)posthumous album (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)posthumous album (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)a remix album (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)debut album (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)greatest hits album (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)compilation (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)compilation album (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)compilation albums (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)box set (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)first album (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)second album (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)third album (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)last album (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)final album (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)visual album (.*)(?:by|released|of|from)/, 'music', 'album_page'],
		[/(.*)(?:is|was|were|are)(.*)video album (.*)(?:by|released|of|from)/, 'music', 'album_page'],

		/* Song */
		[/(.*)(?:is|was|were|are)(.*)song (.*)(?:by|released|of|from|performed)/, 'music', 'song_page'],
		[/(.*)(?:is|was|were|are)(.*)song written by /, 'music', 'song_page'],
		[/(.*)(?:is|was|were|are)(.*)song recorded by /, 'music', 'song_page'],
		[/(.*)(?:is|was|were|are)(.*)song composed by /, 'music', 'song_page'],
		[/(.*)(?:is|was|were|are)(.*)single (.*)(?:by|released|of|from|performed)/, 'music', 'song_page'],

		/* Concerts/Tours */
		[/(.*)(?:is|was|were|are)(.*)concert tour (.*)(?:by|released|of)/, 'music', 'concert_page'],
		[/(.*)(?:is|was|were|are)(.*)tour (.*)(?:by|released|of)/, 'music', 'concert_page'],
		[/(.*)(?:is|was|were|are)(.*)concert (.*)(?:by|released|of)/, 'music', 'concert_page'],



/*======================================================================= 
		Sports 
	=========================================================================*/

		/* Player */
		[/(.*)(?:is|was|were|are)(.*)footballer/, 'sports', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)player/, 'sports', 'artist_page'],

		/* Team */
		[/(.*)(?:is|was|were|are)(.*)(?:team|club) /, 'sports', 'artist_page'],

		/* Tournament */
		[/(.*)(?:is|was|were|are)(.*)tournament /, 'sports', 'artist_page'],
		[/(.*)(?:is|was|were|are)(.*)championship /, 'sports', 'artist_page']

		
	

];


//Defining variables
var music_clean_result = [], music_waste_result = [];

//Defining Magic App
var Magic = {

	//Controller function
	FilterTags: function() {
		$('.search_temporary').each(function(){
			var search_temporary = $(this).index();
			var lineInfos = [$('.search_temporary:eq('+search_temporary+') .nome').text(), $('.search_temporary:eq('+search_temporary+') .desc').text()];

			//Not Usable Titles
			var usable = true;
			for (var useTitle=0; useTitle < notUsableTitles.length; useTitle++) {
				if (lineInfos[0].indexOf(notUsableTitles[useTitle]) >= 0 ) {
					usable = false;
				}
			}
			//Not Usable Descriptions
			for (var useDesc=0; useDesc < notUsableDescriptions.length; useDesc++) {
				if (lineInfos[1].indexOf(notUsableDescriptions[useDesc]) >= 0 ) {
					usable = false;
				}
			}
			//Music Category - Filter
			Magic.FilterMusic(usable, lineInfos);
		});
	},

	//Music Filtering
	FilterMusic: function(usable, lineInfos) {
		if (usable) {
			//Music
			var music_category = 0, page_type = '', category = '';
			console.log(music.length);
			for (var mus = 0; mus < music.length; mus++) {
				if (lineInfos[1].substr(0,190).match(music[mus][0]) != undefined) {
					music_category += 1;
					category = music[mus][1];
					page_type = music[mus][2];
				}
			}
			if (music_category > 0) {
				music_clean_result.push([lineInfos[0], lineInfos[1], category, page_type]);
			} else {
				music_waste_result.push([lineInfos[0], lineInfos[1], category, page_type]);
			}
		} else {
			music_waste_result.push([lineInfos[0], lineInfos[1]]);
		}
	}
}