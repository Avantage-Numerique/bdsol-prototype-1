<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Public for now : middleware('auth:api')->
Route::get('/o', function (Request $request) {
    return view('api', [
        'title' => 'API V1: (' . config('app.name') . " v" . config('app.version') . ')'
    ]);
});


Route::get('/o/v1', function (Request $request) {
    //basic return to have it connected to the webapp
    return response()->json(json_decode('{
    "classes": [
        {
            "slug": "personne",
            "title": "Personnes",
            "intro": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam convallis vehicula enim, sed commodo nunc.",
            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam convallis vehicula enim, sed commodo nunc. Ut vel ante aliquam felis facilisis varius vel a magna. Donec scelerisque augue non nisi vehicula, et tristique urna imperdiet. Aenean sit amet sollicitudin magna, eu ultrices justo. Fusce posuere augue sit amet odio imperdiet, in lobortis eros congue. Phasellus neque orci, vulputate a sollicitudin et, suscipit vel leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris id sem eros.",
            "properties": [
                {
                    "slug": "propriete-01",
                    "title": "Propriété 01",
                    "source": "foaf",
                    "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque fringilla scelerisque est, in tempus mi pellentesque ut. Aliquam tellus tortor, blandit a ipsum nec, ultricies fringilla neque. Sed semper est massa, ut aliquam nisl egestas et. Vestibulum venenatis justo eu iaculis dictum. Sed quis volutpat augue. Sed varius eleifend nisl eget vulputate. Nam ac velit erat. Cras vestibulum elit at lorem luctus hendrerit. Curabitur egestas mi metus, eu hendrerit erat mattis non. Vestibulum id laoreet leo, sed dictum libero. Vestibulum mauris augue, sagittis vitae varius vitae, sagittis vel justo.",
                    "uses": "long texte about the use cases and exemple.",
                    "restrictions" : "Detail about it\'s restrictions.",
                    "required": false
                },
                {
                    "slug": "propriete-02",
                    "title": "Propriété 02",
                    "source": "foaf",
                    "description": "Praesent nec quam dignissim, pretium odio ut, ullamcorper purus. Vestibulum ultricies eros dolor, ut viverra eros dignissim nec. Fusce sapien nunc, consequat vitae semper sed, commodo quis lectus. Vestibulum ullamcorper dolor dolor. Suspendisse potenti. Phasellus eget convallis sem. Sed nisl libero, commodo et lectus eu, sagittis porttitor ipsum. Phasellus vel pulvinar lorem. Vestibulum rhoncus lacus nulla, at congue metus dictum eu. Nam interdum, neque hendrerit semper interdum, tellus orci semper metus, tristique placerat urna tellus at elit. Praesent vitae dolor tortor. Pellentesque tempor, mauris sit amet commodo vestibulum, dui enim cursus tellus, vel dignissim est ante convallis quam. Vestibulum egestas eros eget dui ultrices, id ullamcorper nulla cursus.",
                    "uses": "long texte about the use cases and exemple.",
                    "restrictions" : "Detail about it\'s restrictions.",
                    "required": false
                }
            ],
            "linkedClasses": [
              {
                "class": "projet",
                "link": "part_of",
                "source": "schema.org"
              },
              {
                "class": "team",
                "link": "part_of",
                "source": "schema.org"
              },
              {
                "class": "equipment",
                "link": "own",
                "source": "schema.org"
              }
            ]
        },
        {
          "slug": "projet",
          "title": "Projets",
          "intro": "Proin et tincidunt leo. In pharetra, sapien eget sollicitudin maximus, mi tellus lacinia felis, at porta lorem massa vel ligula",
          "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam convallis vehicula enim, sed commodo nunc. Ut vel ante aliquam felis facilisis varius vel a magna. Donec scelerisque augue non nisi vehicula, et tristique urna imperdiet. Aenean sit amet sollicitudin magna, eu ultrices justo. Fusce posuere augue sit amet odio imperdiet, in lobortis eros congue. Phasellus neque orci, vulputate a sollicitudin et, suscipit vel leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris id sem eros.",
          "properties": [
              {
                  "slug": "propriete-01",
                  "title": "Propriété 01",
                  "source": "foaf",
                  "description": "Morbi vitae mauris eu arcu viverra iaculis. Sed ut vehicula augue. Nam enim tellus, dictum at mauris et, ornare euismod mi. Ut pharetra, diam vel aliquam pellentesque, elit ex aliquam purus, ut rhoncus nisi felis quis magna. Nam consequat quam ipsum, sit amet ornare dolor vestibulum non. Nunc tellus quam, cursus porta mattis vel, condimentum in quam. Duis lorem felis, gravida non gravida eu, tincidunt a mauris. Pellentesque id sollicitudin elit. Duis convallis quis eros ac ullamcorper. Morbi in finibus leo, eget rutrum urna. Praesent faucibus orci nec velit dignissim, sed vestibulum massa porta. Fusce eget purus diam. Nulla luctus nisl id est molestie, at porta velit luctus. Sed sodales convallis bibendum. Cras vehicula est porttitor ipsum viverra blandit. Cras porttitor gravida nisi, in semper odio euismod eget.",
                  "uses": "long texte about the use cases and exemple.",
                  "restrictions" : "Detail about it\'s restrictions.",
                  "required": false
              },
              {
                  "slug": "propriete-02",
                  "title": "Propriété 02",
                  "source": "foaf",
                  "description": "Sed vitae eros et eros pharetra pellentesque nec in lacus. Praesent mollis est ac eros euismod condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dui neque, tincidunt sit amet nibh id, euismod finibus metus. In volutpat nisi in lorem congue blandit. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed porta dictum eros, at ullamcorper risus. Aliquam eu velit a lectus elementum convallis.",
                  "uses": "long texte about the use cases and exemple.",
                  "restrictions" : "Detail about it\'s restrictions.",
                  "required": false
              }
          ],
          "linkedClasses": [
            {
              "class": "personne",
              "link": "part_of",
              "source": "schema.org"
            },
            {
              "class": "team",
              "link": "part_of",
              "source": "schema.org"
            },
            {
              "class": "equipment",
              "link": "own",
              "source": "schema.org"
            }
          ]
      },
      {
        "slug": "team",
        "title": "Équipe",
        "intro": "Proin et tincidunt leo. In pharetra, sapien eget sollicitudin maximus, mi tellus lacinia felis, at porta lorem massa vel ligula",
        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam convallis vehicula enim, sed commodo nunc. Ut vel ante aliquam felis facilisis varius vel a magna. Donec scelerisque augue non nisi vehicula, et tristique urna imperdiet. Aenean sit amet sollicitudin magna, eu ultrices justo. Fusce posuere augue sit amet odio imperdiet, in lobortis eros congue. Phasellus neque orci, vulputate a sollicitudin et, suscipit vel leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris id sem eros.",
        "properties": [
            {
                "slug": "propriete-01",
                "title": "Propriété 01",
                "source": "foaf",
                "description": "Morbi vitae mauris eu arcu viverra iaculis. Sed ut vehicula augue. Nam enim tellus, dictum at mauris et, ornare euismod mi. Ut pharetra, diam vel aliquam pellentesque, elit ex aliquam purus, ut rhoncus nisi felis quis magna. Nam consequat quam ipsum, sit amet ornare dolor vestibulum non. Nunc tellus quam, cursus porta mattis vel, condimentum in quam. Duis lorem felis, gravida non gravida eu, tincidunt a mauris. Pellentesque id sollicitudin elit. Duis convallis quis eros ac ullamcorper. Morbi in finibus leo, eget rutrum urna. Praesent faucibus orci nec velit dignissim, sed vestibulum massa porta. Fusce eget purus diam. Nulla luctus nisl id est molestie, at porta velit luctus. Sed sodales convallis bibendum. Cras vehicula est porttitor ipsum viverra blandit. Cras porttitor gravida nisi, in semper odio euismod eget.",
                "uses": "long texte about the use cases and exemple.",
                "restrictions" : "Detail about it\'s restrictions.",
                "required": false
            },
            {
                "slug": "propriete-02",
                "title": "Propriété 02",
                "source": "foaf",
                "description": "Sed vitae eros et eros pharetra pellentesque nec in lacus. Praesent mollis est ac eros euismod condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dui neque, tincidunt sit amet nibh id, euismod finibus metus. In volutpat nisi in lorem congue blandit. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed porta dictum eros, at ullamcorper risus. Aliquam eu velit a lectus elementum convallis.",
                "uses": "long texte about the use cases and exemple.",
                "restrictions" : "Detail about it\'s restrictions.",
                "required": false
            }
        ],
        "linkedClasses": [
          {
            "class": "projet",
            "link": "part_of",
            "source": "schema.org"
          },
          {
            "class": "projet",
            "link": "part_of",
            "source": "schema.org"
          },
          {
            "class": "equipment",
            "link": "own",
            "source": "schema.org"
          }
        ]
    },
    {
      "slug": "equipement",
      "title": "Équipement",
      "intro": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam convallis vehicula enim, sed commodo nunc.",
      "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam convallis vehicula enim, sed commodo nunc. Ut vel ante aliquam felis facilisis varius vel a magna. Donec scelerisque augue non nisi vehicula, et tristique urna imperdiet. Aenean sit amet sollicitudin magna, eu ultrices justo. Fusce posuere augue sit amet odio imperdiet, in lobortis eros congue. Phasellus neque orci, vulputate a sollicitudin et, suscipit vel leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris id sem eros.",
      "properties": [
          {
              "slug": "propriete-01",
              "title": "Propriété 01",
              "source": "foaf",
              "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque fringilla scelerisque est, in tempus mi pellentesque ut. Aliquam tellus tortor, blandit a ipsum nec, ultricies fringilla neque. Sed semper est massa, ut aliquam nisl egestas et. Vestibulum venenatis justo eu iaculis dictum. Sed quis volutpat augue. Sed varius eleifend nisl eget vulputate. Nam ac velit erat. Cras vestibulum elit at lorem luctus hendrerit. Curabitur egestas mi metus, eu hendrerit erat mattis non. Vestibulum id laoreet leo, sed dictum libero. Vestibulum mauris augue, sagittis vitae varius vitae, sagittis vel justo.",
              "uses": "long texte about the use cases and exemple.",
              "restrictions" : "Detail about it\'s restrictions.",
              "required": false
          },
          {
              "slug": "propriete-02",
              "title": "Propriété 02",
              "source": "foaf",
              "description": "Praesent nec quam dignissim, pretium odio ut, ullamcorper purus. Vestibulum ultricies eros dolor, ut viverra eros dignissim nec. Fusce sapien nunc, consequat vitae semper sed, commodo quis lectus. Vestibulum ullamcorper dolor dolor. Suspendisse potenti. Phasellus eget convallis sem. Sed nisl libero, commodo et lectus eu, sagittis porttitor ipsum. Phasellus vel pulvinar lorem. Vestibulum rhoncus lacus nulla, at congue metus dictum eu. Nam interdum, neque hendrerit semper interdum, tellus orci semper metus, tristique placerat urna tellus at elit. Praesent vitae dolor tortor. Pellentesque tempor, mauris sit amet commodo vestibulum, dui enim cursus tellus, vel dignissim est ante convallis quam. Vestibulum egestas eros eget dui ultrices, id ullamcorper nulla cursus.",
              "uses": "long texte about the use cases and exemple.",
              "restrictions" : "Detail about it\'s restrictions.",
              "required": false
          }
      ],
      "linkedClasses": [
        {
          "class": "personne",
          "link": "part_of",
          "source": "schema.org"
        },
        {
          "class": "projet",
          "link": "part_of",
          "source": "schema.org"
        },
        {
          "class": "team",
          "link": "own",
          "source": "schema.org"
        }
      ]
  }
    ]
}'), 201);
});


//return response()->json(['data' => $user->toArray()], 201);