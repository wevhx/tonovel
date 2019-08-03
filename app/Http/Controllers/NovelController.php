<?php

namespace App\Http\Controllers;

use App\Novel;
use App\Genre;
use App\Library;
use App\Category;
use App\Review;
use App\People;
use App\Publisher;
use App\User;
use App\Changelog;
use App\Group;
use Auth;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class NovelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!Auth::user()){
            request()->session()->flash('danger', 'Login untuk melanjutkan aksimu !!');
            return redirect()->route('login');
        }
        $novel = Novel::paginate(20);
        return view('kontribusi.novel.index')->withNovel($novel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(!Auth::user()){
            request()->session()->flash('danger', 'Login untuk melanjutkan aksimu !!');
            return redirect()->route('login');
        }
        $categories = Category::all()->pluck('name','id');
        $genres = Genre::all()->pluck('name','id');
        $author = People::where('ppl_type','=',1)->pluck('ppl_name','id');
        $artist = People::where('ppl_type','=',2)->pluck('ppl_name','id');
        $enpub = Publisher::where('type','=',1)->pluck('name','id');
        $idpub = Publisher::where('type','=',2)->pluck('name','id');
        return view('kontribusi.novel.create')->withIdpub($idpub)->withEnpub($enpub)->withAuthor($author)->withArtist($artist)->withCategories($categories)->withGenres($genres);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(!Auth::user()){
            request()->session()->flash('danger', 'Login untuk melanjutkan aksimu !!');
            return redirect()->route('login');
        }
        $all = $request->all();
        $messages = [
            'thumb.required' => 'Poster tidak boleh kosong',
            'thumb.image' => 'Poster haruslah berbentuk gambar',
            'thumb.mimes' => 'Dengan format jenis jpeg,png,jpg,gif',
            'thumb.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
        ];
        $thumb = '';
        if(!empty($request->hasFile('thumb'))) $thumb = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        $this->validate(request(), [
            'thumb' => $thumb,
            'title' => 'required',
            'type' => 'required',
            'synopsis' => 'required',
            'year' => 'required',
            'licensed' => 'required',
            'type' => 'required',
        ],$messages);
        @$userimg = $request->file('thumb');
        if(!empty($request->hasFile('thumb'))) $filename = md5($userimg->getClientOriginalName()) . '.' . $userimg->getClientOriginalExtension();
        if(Auth::user()->type > 0){
            $novel = new Novel;
            if(!empty($request->hasFile('thumb'))){
            Image::make($userimg)->resize(263, 376)->save( public_path('uploads/poster/0/' . $filename ) );
            Image::make($userimg)->resize(77, 100)->save( public_path('uploads/poster/1/' . $filename ) );
            Image::make($userimg)->resize(39, 50)->save( public_path('uploads/poster/2/' . $filename ));
            $novel->thumb = $filename;   
            } 
    		$novel->title = $request->title;
    		$novel->alt_title = $request->alt_title;
    		$novel->slug = NovelController::slugify($request->title);
            $novel->type = $request->type;
            $novel->synopsis = $request->synopsis;
            $novel->year = $request->year;
            $novel->country = $request->country;
            $novel->status = $request->status;
            $novel->total = 0;
            $novel->views = 0;
            $novel->total_views = 0;
            $novel->licensed = $request->licensed;
            $novel->save(); 
            if (isset($request->author)) {
                $data = $request->author;
                $data = @array_flip($data);
                $data = array_map(function($type){
                    return array('type' => 1);
                }, $data);
                $novel->peoples()->wherePivot('type',1)->sync($data,false);
            } else {
                $novel->peoples()->sync(array());
            }
            if (isset($request->artist)) {
                $data = $request->artist;
                $data = @array_flip($data);
                $data = array_map(function($type){
                    return array('type' => 2);
                }, $data);
                $novel->peoples()->wherePivot('type',2)->sync($data,false);
            } else {
                $novel->peoples()->sync(array());
            }
            if (isset($request->enpub)) {
                $data = $request->enpub;
                $data = array_flip($data);
                $data = array_map(function($type){
                    return array('type' => 1);
                }, $data);
                $novel->publishers()->wherePivot('type','=',1)->sync($data,false);
            } else {
                $novel->publishers()->sync(array());
            }
            if (isset($request->idpub)) {
                $data = $request->idpub;
                $data = array_flip($data);
                $data = array_map(function($type){
                    return array('type' => 2);
                }, $data);
                $novel->publishers()->wherePivot('type','=',2)->sync($data,false);
            } else {
                $novel->publishers()->sync(array());
            }
            $novel->genres()->sync($request->genre, false);
                $novel->peoples()->sync(array());
            request()->session()->flash('success', ' Novel berhasil ditambahkan !');
            return redirect()->route('novel.index');
        }else{

            if(!empty($request->hasFile('thumb'))){ 
                Image::make($userimg)->resize(263, 376)->save( public_path('uploads/poster/0/' . $filename ) );
                Image::make($userimg)->resize(77, 100)->save( public_path('uploads/poster/1/' . $filename ) );
                Image::make($userimg)->resize(39, 50)->save( public_path('uploads/poster/2/' . $filename ));    
            $all['images'] = $filename;
            }
            $changelog = new Changelog;
            $changelog->type = 0;
            $changelog->changed = 'nnovel';
            $changelog->content = json_encode($all);
            $changelog->user_id = Auth::user()->id;
            $changelog->status = 0;
            $changelog->save();request()->session()->flash('success', ' Novel sudah ditambahkan dan dalam antrian ubahan !');
            return redirect()->route('novel.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Novel  $novel
     * @return \Illuminate\Http\Response
     */
    public function show(Novel $novel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Novel  $novel
     * @return \Illuminate\Http\Response
     */
    public function edit(Novel $novel,$slug)
    {
        if(!Auth::user()){
            request()->session()->flash('danger', 'Login untuk melanjutkan aksimu !!');
            return redirect()->route('login');
        }
        $novel = Novel::whereSlug($slug)->first();
        $categories = Category::all()->pluck('name','id');
        $genres = Genre::all()->pluck('name','id');
        $author = People::where('ppl_type','=',1)->pluck('ppl_name','id');
        $artist = People::where('ppl_type','=',2)->pluck('ppl_name','id');
        $enpub = Publisher::where('type','=',1)->pluck('name','id');
        $idpub = Publisher::where('type','=',2)->pluck('name','id');
        return view('kontribusi.novel.update')->withNovel($novel)->withIdpub($idpub)->withEnpub($enpub)->withAuthor($author)->withArtist($artist)->withCategories($categories)->withGenres($genres);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Novel  $novel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if(!Auth::user()){
            request()->session()->flash('danger', 'Login untuk melanjutkan aksimu !!');
            return redirect()->route('login');
        }
        $all = $request->all();
        $messages = [
            'thumb.required' => 'Poster tidak boleh kosong',
            'thumb.image' => 'Poster haruslah berbentuk gambar',
            'thumb.mimes' => 'Dengan format jenis jpeg,png,jpg,gif',
            'thumb.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
        ];
        $thumb = '';
        if(!empty($request->hasFile('thumb'))) $thumb = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        $this->validate(request(), [
            'thumb' => $thumb,
            'title' => 'required',
            'slug' => 'required|alpha_dash',
            'type' => 'required',
            'synopsis' => 'required',
            'year' => 'required',
            'licensed' => 'required',
            'type' => 'required',
        ],$messages);
        @$userimg = $request->file('thumb');
        if(!empty($request->hasFile('thumb'))) $filename = md5($userimg->getClientOriginalName()) . '.' . $userimg->getClientOriginalExtension();
        if(Auth::user()->type > 0){
            $novel = Novel::find($id);
            if(!empty($request->hasFile('thumb'))){
            Image::make($userimg)->resize(263, 376)->save( public_path('uploads/poster/0/' . $filename ) );
            Image::make($userimg)->resize(77, 100)->save( public_path('uploads/poster/1/' . $filename ) );
            Image::make($userimg)->resize(39, 50)->save( public_path('uploads/poster/2/' . $filename ));
    		$novel->thumb = $filename;    
            }
    		$novel->title = $request->title;
    		$novel->alt_title = $request->alt_title;
    		$novel->slug = $request->slug;
            $novel->type = $request->type;
            $novel->country = $request->country;
            $novel->synopsis = $request->synopsis;
            $novel->year = $request->year;
            $novel->licensed = $request->licensed;
            
            if (isset($request->genre)) {
                $novel->genres()->sync($request->genre);
            } else {
                $novel->genres()->sync(array());
            }
            if (isset($request->author)) {
                $data = $request->author;
                $data = array_flip($data);
                $data = array_map(function($type){
                    return array('type' => 1);
                }, $data);
                $novel->peoples()->wherePivot('type',1)->sync($data);
            } else {
                $novel->peoples()->sync(array());
            }
            if (isset($request->artist)) {
                $data = $request->artist;
                $data = array_flip($data);
                $data = array_map(function($type){
                    return array('type' => 2);
                }, $data);
                $novel->peoples()->wherePivot('type',2)->sync($data);
            } else {
                $novel->peoples()->sync(array());
            }
            if (isset($request->enpub)) {
                $data = $request->enpub;
                $data = array_flip($data);
                $data = array_map(function($type){
                    return array('type' => 1);
                }, $data);
                $novel->publishers()->wherePivot('type','=',1)->sync($data);
            } else {
                $novel->publishers()->sync(array());
            }
            if (isset($request->idpub)) {
                $data = $request->idpub;
                $data = array_flip($data);
                $data = array_map(function($type){
                    return array('type' => 2);
                }, $data);
                $novel->publishers()->wherePivot('type','=',2)->sync($data);
            } else {
                $novel->publishers()->sync(array());
            }
            $novel->save(); 
            request()->session()->flash('success', ' Novel berhasil diubah !');
            return redirect()->route('novel.index');
        }else{
            $novel = Novel::find($id);
            if(empty($filename)) $filename = $novel->thumb;
            $all['images'] = $filename;
            $changelog = new Changelog;
            $changelog->type = 0;
            $changelog->changed = 'snovel';
            $changelog->content = json_encode($all);
            $changelog->user_id = Auth::user()->id;
            $changelog->status = 0;
            $changelog->save(); 
            if(!empty($request->hasFile('thumb'))){
            Image::make($userimg)->resize(263, 376)->save( public_path('uploads/poster/0/' . $filename ) );
            Image::make($userimg)->resize(77, 100)->save( public_path('uploads/poster/1/' . $filename ) );
            Image::make($userimg)->resize(39, 50)->save( public_path('uploads/poster/2/' . $filename ));
            }
            request()->session()->flash('success', ' Novel sudah diubah dan dalam antrian ubahan !');
            return redirect()->route('novel.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Novel  $novel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Novel $novel)
    {
        //
    }
    
    public function getRandom(){
        $novel = Novel::inRandomOrder()->first();
        return redirect()->route('novel.lihat',array('slug' => $novel->slug));
    }
    public function getAll(Request $request){
        $genres = Genre::pluck('name', 'id');
        $cat = Category::pluck('name', 'id');
        if($request->filter != 'yes'){
        $novel = Novel::orderBy('created_at', 'desc')->paginate(20);
        return view('novel.index')->withNovel($novel)->withGenres($genres)->withCategory($cat);
        }else{
        $query = Novel::query();
        if(isset($request->genre)) {
            foreach ((array)$request->genre as $genre)
            {
                $query->whereHas('genres', function ($f) use ($genre)
                {
                    $f->where('genres.id', $genre);
                });
            }
        }  
        if(isset($request->category)) {
            $query->where('type', $request->category);
        }  
        if(isset($request->country)) {
            $query->where('country', $request->country);
        }  
        if(isset($request->year)) {
            foreach ((array)$request->year as $year)
            {
                $query->where('year', $year);
            }
        }  
        if(isset($request->type)) {
            $query->where('type', $request->type);
        }  
        if(isset($request->status)) {
            $query->where('status', $request->status);
        }

        if(isset($request->sort)) {
            if($request->sort == 'default'){
            $query->orderBy('title');
            }elseif($request->sort == 'name-asc'){
                $query->orderBy('title', 'asc');
            }elseif($request->sort == 'name-desc'){
                $query->orderBy('title', 'desc');
            }elseif($request->sort == 'viewer-asc'){
                $query->orderBy('total_views', 'asc');
            }elseif($request->sort == 'viewer-desc'){
                $query->orderBy('total_views', 'desc');
            }elseif($request->sort == 'newer'){
                $query->orderBy('created_at', 'desc');
            }elseif($request->sort == 'older'){
                $query->orderBy('created_at', 'asc');
            }
        }
        $novelResults = $query->paginate(20);
        return view('novel.index')->withNovel($novelResults)->withGenres($genres)->withCategory($cat);
        }
    }
    public static function slugify($text)
    {
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
      $text = preg_replace('~[^-\w]+~', '', $text);
      $text = trim($text, '-');
      $text = preg_replace('~-+~', '-', $text);
      $text = strtolower($text);
      if (empty($text)) {
        return 'n-a';
      }
      return $text;
    }
    public static function truncate($str, $chars, $end = '...') {
        if (strlen($str) <= $chars) return $str;
        $new = substr($str, 0, $chars + 1);
        return substr($new, 0, strrpos($new, ' ')) . $end;
    }
    // 
    // 
    public static function country( $code ){ $country = ''; if( $code == 'AF' ) $country = 'Afghanistan'; if( $code == 'AX' ) $country = 'Aland Islands'; if( $code == 'AL' ) $country = 'Albania'; if( $code == 'DZ' ) $country = 'Algeria'; if( $code == 'AS' ) $country = 'American Samoa'; if( $code == 'AD' ) $country = 'Andorra'; if( $code == 'AO' ) $country = 'Angola'; if( $code == 'AI' ) $country = 'Anguilla'; if( $code == 'AQ' ) $country = 'Antarctica'; if( $code == 'AG' ) $country = 'Antigua and Barbuda'; if( $code == 'AR' ) $country = 'Argentina'; if( $code == 'AM' ) $country = 'Armenia'; if( $code == 'AW' ) $country = 'Aruba'; if( $code == 'AU' ) $country = 'Australia'; if( $code == 'AT' ) $country = 'Austria'; if( $code == 'AZ' ) $country = 'Azerbaijan'; if( $code == 'BS' ) $country = 'Bahamas the'; if( $code == 'BH' ) $country = 'Bahrain'; if( $code == 'BD' ) $country = 'Bangladesh'; if( $code == 'BB' ) $country = 'Barbados'; if( $code == 'BY' ) $country = 'Belarus'; if( $code == 'BE' ) $country = 'Belgium'; if( $code == 'BZ' ) $country = 'Belize'; if( $code == 'BJ' ) $country = 'Benin'; if( $code == 'BM' ) $country = 'Bermuda'; if( $code == 'BT' ) $country = 'Bhutan'; if( $code == 'BO' ) $country = 'Bolivia'; if( $code == 'BA' ) $country = 'Bosnia and Herzegovina'; if( $code == 'BW' ) $country = 'Botswana'; if( $code == 'BV' ) $country = 'Bouvet Island (Bouvetoya)'; if( $code == 'BR' ) $country = 'Brazil'; if( $code == 'IO' ) $country = 'British Indian Ocean Territory (Chagos Archipelago)'; if( $code == 'VG' ) $country = 'British Virgin Islands'; if( $code == 'BN' ) $country = 'Brunei Darussalam'; if( $code == 'BG' ) $country = 'Bulgaria'; if( $code == 'BF' ) $country = 'Burkina Faso'; if( $code == 'BI' ) $country = 'Burundi'; if( $code == 'KH' ) $country = 'Cambodia'; if( $code == 'CM' ) $country = 'Cameroon'; if( $code == 'CA' ) $country = 'Canada'; if( $code == 'CV' ) $country = 'Cape Verde'; if( $code == 'KY' ) $country = 'Cayman Islands'; if( $code == 'CF' ) $country = 'Central African Republic'; if( $code == 'TD' ) $country = 'Chad'; if( $code == 'CL' ) $country = 'Chile'; if( $code == 'CN' ) $country = 'Cina'; if( $code == 'CX' ) $country = 'Christmas Island'; if( $code == 'CC' ) $country = 'Cocos (Keeling) Islands'; if( $code == 'CO' ) $country = 'Colombia'; if( $code == 'KM' ) $country = 'Comoros the'; if( $code == 'CD' ) $country = 'Congo'; if( $code == 'CG' ) $country = 'Congo the'; if( $code == 'CK' ) $country = 'Cook Islands'; if( $code == 'CR' ) $country = 'Costa Rica'; if( $code == 'CI' ) $country = 'Cote d\'Ivoire'; if( $code == 'HR' ) $country = 'Croatia'; if( $code == 'CU' ) $country = 'Cuba'; if( $code == 'CY' ) $country = 'Cyprus'; if( $code == 'CZ' ) $country = 'Czech Republic'; if( $code == 'DK' ) $country = 'Denmark'; if( $code == 'DJ' ) $country = 'Djibouti'; if( $code == 'DM' ) $country = 'Dominica'; if( $code == 'DO' ) $country = 'Dominican Republic'; if( $code == 'EC' ) $country = 'Ecuador'; if( $code == 'EG' ) $country = 'Egypt'; if( $code == 'SV' ) $country = 'El Salvador'; if( $code == 'GQ' ) $country = 'Equatorial Guinea'; if( $code == 'ER' ) $country = 'Eritrea'; if( $code == 'EE' ) $country = 'Estonia'; if( $code == 'ET' ) $country = 'Ethiopia'; if( $code == 'FO' ) $country = 'Faroe Islands'; if( $code == 'FK' ) $country = 'Falkland Islands (Malvinas)'; if( $code == 'FJ' ) $country = 'Fiji the Fiji Islands'; if( $code == 'FI' ) $country = 'Finland'; if( $code == 'FR' ) $country = 'France, French Republic'; if( $code == 'GF' ) $country = 'French Guiana'; if( $code == 'PF' ) $country = 'French Polynesia'; if( $code == 'TF' ) $country = 'French Southern Territories'; if( $code == 'GA' ) $country = 'Gabon'; if( $code == 'GM' ) $country = 'Gambia the'; if( $code == 'GE' ) $country = 'Georgia'; if( $code == 'DE' ) $country = 'Germany'; if( $code == 'GH' ) $country = 'Ghana'; if( $code == 'GI' ) $country = 'Gibraltar'; if( $code == 'GR' ) $country = 'Greece'; if( $code == 'GL' ) $country = 'Greenland'; if( $code == 'GD' ) $country = 'Grenada'; if( $code == 'GP' ) $country = 'Guadeloupe'; if( $code == 'GU' ) $country = 'Guam'; if( $code == 'GT' ) $country = 'Guatemala'; if( $code == 'GG' ) $country = 'Guernsey'; if( $code == 'GN' ) $country = 'Guinea'; if( $code == 'GW' ) $country = 'Guinea-Bissau'; if( $code == 'GY' ) $country = 'Guyana'; if( $code == 'HT' ) $country = 'Haiti'; if( $code == 'HM' ) $country = 'Heard Island and McDonald Islands'; if( $code == 'VA' ) $country = 'Holy See (Vatican City State)'; if( $code == 'HN' ) $country = 'Honduras'; if( $code == 'HK' ) $country = 'Hong Kong'; if( $code == 'HU' ) $country = 'Hungary'; if( $code == 'IS' ) $country = 'Iceland'; if( $code == 'IN' ) $country = 'India'; if( $code == 'ID' ) $country = 'Indonesia'; if( $code == 'IR' ) $country = 'Iran'; if( $code == 'IQ' ) $country = 'Iraq'; if( $code == 'IE' ) $country = 'Ireland'; if( $code == 'IM' ) $country = 'Isle of Man'; if( $code == 'IL' ) $country = 'Israel'; if( $code == 'IT' ) $country = 'Italy'; if( $code == 'JM' ) $country = 'Jamaica'; if( $code == 'JP' ) $country = 'Jepang'; if( $code == 'JE' ) $country = 'Jersey'; if( $code == 'JO' ) $country = 'Jordan'; if( $code == 'KZ' ) $country = 'Kazakhstan'; if( $code == 'KE' ) $country = 'Kenya'; if( $code == 'KI' ) $country = 'Kiribati'; if( $code == 'KP' ) $country = 'Korea'; if( $code == 'KR' ) $country = 'Korea'; if( $code == 'KW' ) $country = 'Kuwait'; if( $code == 'KG' ) $country = 'Kyrgyz Republic'; if( $code == 'LA' ) $country = 'Lao'; if( $code == 'LV' ) $country = 'Latvia'; if( $code == 'LB' ) $country = 'Lebanon'; if( $code == 'LS' ) $country = 'Lesotho'; if( $code == 'LR' ) $country = 'Liberia'; if( $code == 'LY' ) $country = 'Libyan Arab Jamahiriya'; if( $code == 'LI' ) $country = 'Liechtenstein'; if( $code == 'LT' ) $country = 'Lithuania'; if( $code == 'LU' ) $country = 'Luxembourg'; if( $code == 'MO' ) $country = 'Macao'; if( $code == 'MK' ) $country = 'Macedonia'; if( $code == 'MG' ) $country = 'Madagascar'; if( $code == 'MW' ) $country = 'Malawi'; if( $code == 'MY' ) $country = 'Malaysia'; if( $code == 'MV' ) $country = 'Maldives'; if( $code == 'ML' ) $country = 'Mali'; if( $code == 'MT' ) $country = 'Malta'; if( $code == 'MH' ) $country = 'Marshall Islands'; if( $code == 'MQ' ) $country = 'Martinique'; if( $code == 'MR' ) $country = 'Mauritania'; if( $code == 'MU' ) $country = 'Mauritius'; if( $code == 'YT' ) $country = 'Mayotte'; if( $code == 'MX' ) $country = 'Mexico'; if( $code == 'FM' ) $country = 'Micronesia'; if( $code == 'MD' ) $country = 'Moldova'; if( $code == 'MC' ) $country = 'Monaco'; if( $code == 'MN' ) $country = 'Mongolia'; if( $code == 'ME' ) $country = 'Montenegro'; if( $code == 'MS' ) $country = 'Montserrat'; if( $code == 'MA' ) $country = 'Morocco'; if( $code == 'MZ' ) $country = 'Mozambique'; if( $code == 'MM' ) $country = 'Myanmar'; if( $code == 'NA' ) $country = 'Namibia'; if( $code == 'NR' ) $country = 'Nauru'; if( $code == 'NP' ) $country = 'Nepal'; if( $code == 'AN' ) $country = 'Netherlands Antilles'; if( $code == 'NL' ) $country = 'Netherlands the'; if( $code == 'NC' ) $country = 'New Caledonia'; if( $code == 'NZ' ) $country = 'New Zealand'; if( $code == 'NI' ) $country = 'Nicaragua'; if( $code == 'NE' ) $country = 'Niger'; if( $code == 'NG' ) $country = 'Nigeria'; if( $code == 'NU' ) $country = 'Niue'; if( $code == 'NF' ) $country = 'Norfolk Island'; if( $code == 'MP' ) $country = 'Northern Mariana Islands'; if( $code == 'NO' ) $country = 'Norway'; if( $code == 'OM' ) $country = 'Oman'; if( $code == 'PK' ) $country = 'Pakistan'; if( $code == 'PW' ) $country = 'Palau'; if( $code == 'PS' ) $country = 'Palestinian Territory'; if( $code == 'PA' ) $country = 'Panama'; if( $code == 'PG' ) $country = 'Papua New Guinea'; if( $code == 'PY' ) $country = 'Paraguay'; if( $code == 'PE' ) $country = 'Peru'; if( $code == 'PH' ) $country = 'Philippines'; if( $code == 'PN' ) $country = 'Pitcairn Islands'; if( $code == 'PL' ) $country = 'Poland'; if( $code == 'PT' ) $country = 'Portugal, Portuguese Republic'; if( $code == 'PR' ) $country = 'Puerto Rico'; if( $code == 'QA' ) $country = 'Qatar'; if( $code == 'RE' ) $country = 'Reunion'; if( $code == 'RO' ) $country = 'Romania'; if( $code == 'RU' ) $country = 'Russian Federation'; if( $code == 'RW' ) $country = 'Rwanda'; if( $code == 'BL' ) $country = 'Saint Barthelemy'; if( $code == 'SH' ) $country = 'Saint Helena'; if( $code == 'KN' ) $country = 'Saint Kitts and Nevis'; if( $code == 'LC' ) $country = 'Saint Lucia'; if( $code == 'MF' ) $country = 'Saint Martin'; if( $code == 'PM' ) $country = 'Saint Pierre and Miquelon'; if( $code == 'VC' ) $country = 'Saint Vincent and the Grenadines'; if( $code == 'WS' ) $country = 'Samoa'; if( $code == 'SM' ) $country = 'San Marino'; if( $code == 'ST' ) $country = 'Sao Tome and Principe'; if( $code == 'SA' ) $country = 'Saudi Arabia'; if( $code == 'SN' ) $country = 'Senegal'; if( $code == 'RS' ) $country = 'Serbia'; if( $code == 'SC' ) $country = 'Seychelles'; if( $code == 'SL' ) $country = 'Sierra Leone'; if( $code == 'SG' ) $country = 'Singapore'; if( $code == 'SK' ) $country = 'Slovakia (Slovak Republic)'; if( $code == 'SI' ) $country = 'Slovenia'; if( $code == 'SB' ) $country = 'Solomon Islands'; if( $code == 'SO' ) $country = 'Somalia, Somali Republic'; if( $code == 'ZA' ) $country = 'South Africa'; if( $code == 'GS' ) $country = 'South Georgia and the South Sandwich Islands'; if( $code == 'ES' ) $country = 'Spain'; if( $code == 'LK' ) $country = 'Sri Lanka'; if( $code == 'SD' ) $country = 'Sudan'; if( $code == 'SR' ) $country = 'Suriname'; if( $code == 'SJ' ) $country = 'Svalbard & Jan Mayen Islands'; if( $code == 'SZ' ) $country = 'Swaziland'; if( $code == 'SE' ) $country = 'Sweden'; if( $code == 'CH' ) $country = 'Switzerland, Swiss Confederation'; if( $code == 'SY' ) $country = 'Syrian Arab Republic'; if( $code == 'TW' ) $country = 'Taiwan'; if( $code == 'TJ' ) $country = 'Tajikistan'; if( $code == 'TZ' ) $country = 'Tanzania'; if( $code == 'TH' ) $country = 'Thailand'; if( $code == 'TL' ) $country = 'Timor-Leste'; if( $code == 'TG' ) $country = 'Togo'; if( $code == 'TK' ) $country = 'Tokelau'; if( $code == 'TO' ) $country = 'Tonga'; if( $code == 'TT' ) $country = 'Trinidad and Tobago'; if( $code == 'TN' ) $country = 'Tunisia'; if( $code == 'TR' ) $country = 'Turkey'; if( $code == 'TM' ) $country = 'Turkmenistan'; if( $code == 'TC' ) $country = 'Turks and Caicos Islands'; if( $code == 'TV' ) $country = 'Tuvalu'; if( $code == 'UG' ) $country = 'Uganda'; if( $code == 'UA' ) $country = 'Ukraine'; if( $code == 'AE' ) $country = 'United Arab Emirates'; if( $code == 'GB' ) $country = 'United Kingdom'; if( $code == 'US' ) $country = 'United States of America'; if( $code == 'UM' ) $country = 'United States Minor Outlying Islands'; if( $code == 'VI' ) $country = 'United States Virgin Islands'; if( $code == 'UY' ) $country = 'Uruguay, Eastern Republic of'; if( $code == 'UZ' ) $country = 'Uzbekistan'; if( $code == 'VU' ) $country = 'Vanuatu'; if( $code == 'VE' ) $country = 'Venezuela'; if( $code == 'VN' ) $country = 'Vietnam'; if( $code == 'WF' ) $country = 'Wallis and Futuna'; if( $code == 'EH' ) $country = 'Western Sahara'; if( $code == 'YE' ) $country = 'Yemen'; if( $code == 'ZM' ) $country = 'Zambia'; if( $code == 'ZW' ) $country = 'Zimbabwe'; if( $country == '') $country = $code; return $country; }


    public function lihat($id){
        $novel = Novel::where('slug','=',$id)->first();
        if($novel == false ){
            abort(404);
        }else{
            @$userid = Auth::user()->id;
            if(isset($userid)){
                ActivityController::akt($userid,1,1,$novel->id);
            $libr = Library::where('novel_id','=',$novel->id)->where('user_id','=',$userid)->first();
            $revi = Review::where('novel_id','=',$novel->id)->where('user_id','=',$userid)->first();
            if($revi != null){
                return view('novel.show')->withNovel($novel)->withLibr($libr)->withRef($revi);
            }else{
                return view('novel.show')->withNovel($novel)->withLibr($libr);
            }
            }else{
                return view('novel.show')->withNovel($novel);
            }
        }
    }

    public function lihatc($slug,$cat){
        $novel = Novel::whereSlug($slug)->first();
        if(in_array($cat, array('terkait','rekomendasi','jilid','group'))){
        if($novel == false ){
            abort(404);
        }else{
            @$userid = Auth::user()->id;
            if(isset($userid)){
            $libr = Library::where('novel_id','=',$novel->id)->where('user_id','=',$userid)->first();
            $revi = Review::where('novel_id','=',$novel->id)->where('user_id','=',$userid)->first();
            if($revi != null){
                return view('novel.show')->withNovel($novel)->withLibr($libr)->withRef($revi)->withType($cat);
            }else{
                return view('novel.show')->withNovel($novel)->withLibr($libr)->withType($cat);
            }
            }else{
                return view('novel.show')->withNovel($novel)->withType($cat);
            }
        }
        }else{
            return abort(404);
        }
    }
    
    public function getSearchAPI(){
        $query=  Input::get('s');
        if(strlen($query) > 2){
           $novel = Novel::where('title', 'LIKE', "%$query%" )->orwhere('alt_title', 'LIKE', "%$query%" )
                ->orderby('title', 'asc')
                ->get()
                ->take(5);                    
                return response()->json(array('keyword'=>$query,'novel'=>$novel));
        }else{
            return response()->json(array('keyword'=>$query,'novel'=>array()));
        }
    }
    // Dev info
    public function tampil($id){
        $novel = Novel::where('slug','=',$id)->first();
        $j['author'] = $novel->peoples;
        $j['genre'] = $novel->genres;
        $j['publisher'] = $novel->publishers;
        $j['related'] = $novel->relateds;
        $j['library'] = $novel->library->count()/count(array_sum($novel->library));
        $j['info'] = $novel;
        return $j;
    }
    public static function GetStat($slug){
        $user = User::whereName($slug)->first();
$total = $user->library->count();
$totala = $user->library()->where('status','=','1')->count();
$totalb = $user->library()->where('status','=','2')->count();
$totalc = $user->library()->where('status','=','3')->count();
$totald = $user->library()->where('status','=','4')->count();
$totale = $user->library()->where('status','=','5')->count();
$d['dibaca'][] =  $user->library()->where('status','=','1')->whereHas('novels', function($q){
    $q->where('type', '=', 1);
})->count();
$d['selesai'][] =  $user->library()->where('status','=','2')->whereHas('novels', function($q){
    $q->where('type', '=', 1);
})->count();
$d['ditahan'][] =  $user->library()->where('status','=','3')->whereHas('novels', function($q){
    $q->where('type', '=', 1);
})->count();
$d['direncanakan'][] =  $user->library()->where('status','=','4')->whereHas('novels', function($q){
    $q->where('type', '=', 1);
})->count();
$d['dibuang'][] =  $user->library()->where('status','=','5')->whereHas('novels', function($q){
    $q->where('type', '=', 1);
})->count();
//Webnovel
$d['dibaca'][] =  $user->library()->where('status','=','1')->whereHas('novels', function($q){
    $q->where('type', '=', 2);
})->count();
$d['selesai'][] =  $user->library()->where('status','=','2')->whereHas('novels', function($q){
    $q->where('type', '=', 2);
})->count();
$d['ditahan'][] =  $user->library()->where('status','=','3')->whereHas('novels', function($q){
    $q->where('type', '=', 2);
})->count();
$d['direncanakan'][1] =  $user->library()->where('status','=','4')->whereHas('novels', function($q){
    $q->where('type', '=', 2);
})->count();
$d['dibuang'][] =  $user->library()->where('status','=','5')->whereHas('novels', function($q){
    $q->where('type', '=', 2);
})->count();
//Other
$d['dibaca'][] =  $user->library()->where('status','=','1')->whereHas('novels', function($q){
    $q->where('type', '>=', 3);
})->count();
$d['selesai'][] =  $user->library()->where('status','=','2')->whereHas('novels', function($q){
    $q->where('type', '>=', 3);
})->count();
$d['ditahan'][] =  $user->library()->where('status','=','3')->whereHas('novels', function($q){
    $q->where('type', '>=', 3);
})->count();
$d['direncanakan'][] =  $user->library()->where('status','=','4')->whereHas('novels', function($q){
    $q->where('type', '>=', 3);
})->count();
$d['dibuang'][] =  $user->library()->where('status','=','5')->whereHas('novels', function($q){
    $q->where('type', '>=', 3);
})->count();
$app['light'] = json_encode([$d['dibaca'][0],$d['selesai'][0],$d['ditahan'][0],$d['direncanakan'][0],$d['dibuang'][0],0]);
$app['web'] = json_encode([$d['dibaca'][1],$d['selesai'][1],$d['ditahan'][1],$d['direncanakan'][1],$d['dibuang'][1],0]);
$app['other'] = json_encode([$d['dibaca'][2],$d['selesai'][2],$d['ditahan'][2],$d['direncanakan'][2],$d['dibuang'][2],0]);
//
$app['rlight'] = json_encode([NovelController::perc($d['dibaca'][0],$totala),NovelController::perc($d['selesai'][0],$totalb),NovelController::perc($d['ditahan'][0],$totalc),NovelController::perc($d['direncanakan'][0],$totald),NovelController::perc($d['dibuang'][0],$totale),0]);
$app['rweb'] = json_encode([NovelController::perc($d['dibaca'][1],$totala),NovelController::perc($d['selesai'][1],$totalb),NovelController::perc($d['ditahan'][1],$totalc),NovelController::perc($d['direncanakan'][1],$totald),NovelController::perc($d['dibuang'][1],$totale),0]);
$app['rother'] = json_encode([NovelController::perc($d['dibaca'][2],$totala),NovelController::perc($d['selesai'][2],$totalb),NovelController::perc($d['ditahan'][2],$totalc),NovelController::perc($d['direncanakan'][2],$totald),NovelController::perc($d['dibuang'][2],$totale),0]);
return $app;
    }
    public static function perc($count = 0,$total = 0){
        if($count == 0){
            return 0;
        }
        $perce = $count * 100 / $total;
        if(strlen($perce) > 4){
            return substr($perce,0,2);
        }
        return $perce;
    }
    public static function getVote($id){
        $novel = Novel::where('slug','=',$id)->first();
        $i = 0; 
        $j['total'] = $novel->library->count();
        if($j['total'] < 1){
            $j['data'] = 0;
            $j['votg'] = 0;
            return $j;
        }
        foreach($novel->library as $data){
            $j['data'][$i] = substr($data->score,0,1);
            $j['raw'][$i] = substr($data->score,0,1);
            $i++;
            }
            $j['data'] = array_count_values($j['data']);          
            if(empty($j['data'][5])) $j['data'][5] = 0;
            if(empty($j['data'][4])) $j['data'][4] = 0;
            if(empty($j['data'][3])) $j['data'][3] = 0;
            if(empty($j['data'][2])) $j['data'][2] = 0;
            if(empty($j['data'][1])) $j['data'][1] = 0;
            $votg = NovelController::array_avg($j['raw']);
            if(empty($votg[5]['avg'])) $votg[5]['avg'] = 0;
            if(empty($votg[4]['avg'])) $votg[4]['avg'] = 0;
            if(empty($votg[3]['avg'])) $votg[3]['avg'] = 0;
            if(empty($votg[2]['avg'])) $votg[2]['avg'] = 0;
            if(empty($votg[1]['avg'])) $votg[1]['avg'] = 0;
            $j['votg'] = $votg;
            return $j;
        }
    public static function array_avg($array, $round=1){
            $num = count($array);
            return array_map(
                function($val) use ($num,$round){
                    return array('count'=>$val,'avg'=>round($val/$num*100, $round));
                },
                array_count_values($array));
        }
    public static function uinfo($data){
    $user = User::find($data);
    return $user;
    }
    public static function ugroup($data){
        $group = Group::find($data);
        return $group;
    }
        
    public static function exp($total){
        if($total < 100){
            $d['level'] = 1;
            $d['rank'] = 'Pemula';
        }elseif($total < 200){
            $d['level'] = 2;
            $d['rank'] = 'Pengguna';
        }elseif($total < 500){
            $d['level'] = 3;
            $d['rank'] = 'Maniak';
        }elseif($total < 1000){
            $d['level'] = 4;
            $d['rank'] = 'Addict';
        }elseif($total < 5000){
            $d['level'] = 5;
            $d['rank'] = 'Kutu Buku';
        }elseif($total < 10000){
            $d['level'] = 6;
            $d['rank'] = 'Penggila';
        }
        return $d;
    }
    public static function imggo($d,$size = 0,$filename){
        if($filename == '/uploads/user/default.png' OR $filename == '/img/noimg.png'){
            return url($filename);
        }
        if($size == 2){
            return url('/uploads/'.$d.'/'.$size.'/'.$filename);
        }elseif($size == 1){
            return url('/uploads/'.$d.'/'.$size.'/'.$filename);
        }elseif($size == 0){
            return url('/uploads/'.$d.'/'.$size.'/'.$filename);
        }else{
            return url('/uploads/'.$d.'/'.$size.'/'.$filename);
        }
    }

    public static function minfo($type,$id){
        if($type == 0){
            $novel = Novel::where('id',$id)->first();
            return $novel;
        }elseif($type == 1){
            $Chapter = Chapter::find($id)->first();
            return $Chapter;
        }elseif($type == 2){
            $People = People::find($id)->first();
            return $People;
        }else{
            return false;
        }
    }
    public static function getscore($id){
        $novel = Novel::where('slug','=',$id)->first();
        $i = 0;
        $totalStars = $novel->library->count();
        if(!empty($totalStars)){
        foreach($novel->library as $skoring){
            $skor[$i] = $skoring->score;
            $i++;
        }
        $total = array_sum($skor);
        @$avg = $total/count($skor);
        return $avg;
        }else{
            return 0;
        }
    }
}
