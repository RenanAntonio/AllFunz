/* Tags to skip on search Titles */ 
var notUsableTitles = ["surname", "redirects", "disambiguation", "may refer to:", "may also refer to:", "(genre)", "list of","List of", "lists of","Lists of", "(viral", "filmography", "discography", "videography", "legal disputes", "religious debates", "controversy over", "fandom", "-related", "'s health", "'s appearance", "award", "awards", "(franchise)", "(film series)", "(given name)", "undefined", "personal relationships of", "(season "]; 
/* Tags to skip on search Descriptions */ 
var notUsableDescriptions = ["redirects", "disambiguation", "paedophile", "may refer to:", "may refer to", "may also refer to:", "bible", "undefined", "is a title given by", "personal relationships of", "is a phrase", "refers to the", "is a genre of", "given name that"];

/* Tags by category */
var articlesTags = [

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
var articles_clean_result = [], articles_waste_result = [];

//Defining Magic App
var Magic = {
	//Controller function
	FilterTags: function() {
		setTimeout(function(){
			var qntItems = $('.search_temporary').length;
			$('.search_temporary').each(function(index){
				var search_temporary = index;
				var nameArt = $('.search_temporary:eq('+search_temporary+') .nome').text();
				var descArt = $('.search_temporary:eq('+search_temporary+') .desc').text();
				var lineInfos = [nameArt, descArt];
				
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
				Magic.FilterArticle(usable, lineInfos);

			}).promise().done(function(){
				
			    //Show usable articles
				console.log('Articles OK', articles_clean_result);
			    //Show wasted articles
			    console.log('Articles NOK', articles_waste_result);

			    //Insert filtered search
			    for (var i = 0; i < articles_clean_result.length; i++) {
			        //Collects Infos from Article
			        var articleName = articles_clean_result[i][0].replace('.', ''), 
			    	articleDescription = articles_clean_result[i][1], 
			        articleCategory = articles_clean_result[i][2], 
			        articlePageType = articles_clean_result[i][3];
			        var articleID = '';
			        //var articleID = SaveArticleIfNotExists(articleName, articleDescription, articleCategory, articlePageType);

			        //Short description
			        var partA = '', partB = '';

			        if (articleDescription.substring(328,329) != "  ") {
			        	partA = articleDescription.substring(0,329);
			            if(partA.substring(327,328) == "" && partA.substring(328,329) == "") {
			            	articleDescription = partA;
			            } else {
			            	partB = articleDescription.substring(329);
			              	partB = partB.split(" ")[0];
			              	articleDescription = partA+partB+"...";
			            }
			        }
			        var newMovie = '';
			        if (articleCategory === "movies/television") {
			        	newMovie = "movies";
			        } else {
			        	newMovie = articleCategory;
			        }

			        $('.container').append(
			        	'<div class="search_results" type="'+articleCategory+'">'+
			            	'<a class="url" eq="'+i+'" href="article/'+articleID+'/'+replaceURL(articles_clean_result[i][0])+'.html">'+
				                '<div class="avatar"></div>'+
				                '<div class="wrap">'+
				                	'<span class="category '+newMovie+'">'+articleCategory+'</span>'+
				                	'<div class="name">'+articleName+'</div>'+
				                  	'<div class="desc">'+articleDescription+'</div>'+
				                '</div>'+
			              	'</a>'+
			          	'</div>');
			      }
			      //Show results
			      $('.search_temporary').remove();
			      $('.loading').remove();
			      /*for (var i=0; i < 10; i++) {
			        $('.search_results:eq('+i+')').fadeIn(1500);
			      }
			      $('.search_results:visible').last().after('<div class="loadMore">LOAD MORE</div>');*/
			      $('.search_results').fadeIn(1500);
			      
			      //Filter
			      function foundCategory(categoryParam) {
			        $('.search_results').each(function(){
			          if ($(this).find('.category').text() === categoryParam) {
			            if (categoryParam === "movies/television") {
			              $('.spheres li.movies').attr('style', 'display: inline-block');
			            } else {
			              $('.spheres li.'+ categoryParam).attr('style', 'display: inline-block');
			            }
			          }
			        });
			      }
			      var arrayCategories = ["movies/television", "music", "sports", "games", "literature", "others"];
			      for (i=0; i < arrayCategories.length; i++) {
			        foundCategory(arrayCategories[i]);
			      }

			      //Filter clicks
			      $('.spheres li').click(function() {
			      	var cat = $(this).attr('class');
			      	cat = cat.split(' ')[0];
			      	if (cat === "movies") {
			      		cat = "movies/television";
			      	}
			      	if ($(this).hasClass('active')) {
			        	$(this).removeClass('active');
		        		$('.search_results').each(function(){
			        	  	if ($(this).find('.category').text() === cat) {
			        	  		$(this).hide();
			        	  	}
		        		});
			        } else {
			          	$(this).addClass('active');
			          	$('.search_results').each(function(){
			            	if ($(this).find('.category').text() === cat) {
			            		$(this).show();
			            	}
			          	});
			        }
			      });

			});

		}, 2000);
	},

	//Article Filtering
	FilterArticle: function(usable, lineInfos) {

		if (usable) {
			//Article is valid!
			var categories = 0, page_type = '', category = '';
			for (var art = 0; art < articlesTags.length; art++) {
				if (lineInfos[1].substr(0,190).match(articlesTags[art][0]) != undefined) {
					categories += 1;
					category = articlesTags[art][1];
					page_type = articlesTags[art][2];
				}
			}
			//Save usable articles
			if (category === "" && page_type === "") {
				category = "others";
				page_type = "others";
			}
			articles_clean_result.push([lineInfos[0], lineInfos[1], category, page_type]);
		} else {
			//Save not usable articles
			articles_waste_result.push([lineInfos[0], lineInfos[1], category, page_type]);
		}
	}
}