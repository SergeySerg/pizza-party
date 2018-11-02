@php
$chus = 0;
$znam = 0;
$raty = 0;
if($revsettings->first()->getAttributeTranslate('is_cleanness') && $review->getAttributeTranslate('cleanness')){
    $chus = intval($review->getAttributeTranslate('cleanness'));
}
if($revsettings->first()->getAttributeTranslate('is_сosiness') && $review->getAttributeTranslate('сosiness')){
    $chus = $chus + intval($review->getAttributeTranslate('сosiness'));
}
if($revsettings->first()->getAttributeTranslate('is_location') && $review->getAttributeTranslate('location')){
    $chus = $chus + intval($review->getAttributeTranslate('location'));
}
if($revsettings->first()->getAttributeTranslate('is_food') && $review->getAttributeTranslate('food')){
    $chus = $chus + intval($review->getAttributeTranslate('food'));
}
if($revsettings->first()->getAttributeTranslate('is_wifi') && $review->getAttributeTranslate('wifi')){
    $chus = $chus + intval($review->getAttributeTranslate('wifi'));
}
if($revsettings->first()->getAttributeTranslate('is_price_quality') && $review->getAttributeTranslate('price_quality')){
    $chus = $chus + intval($review->getAttributeTranslate('price_quality'));
}
if($revsettings->first()->getAttributeTranslate('is_family_hotel') && $review->getAttributeTranslate('family_hotel')){
    $chus = $chus + intval($review->getAttributeTranslate('family_hotel'));
}
if($revsettings->first()->getAttributeTranslate('is_rest_children') && $review->getAttributeTranslate('rest_children')){
    $chus = $chus + intval($review->getAttributeTranslate('rest_children'));
}
if($revsettings->first()->getAttributeTranslate('is_young') && $review->getAttributeTranslate('young')){
    $chus = $chus + intval($review->getAttributeTranslate('young'));
}
if($revsettings->first()->getAttributeTranslate('is_polite') && $review->getAttributeTranslate('polite')){
    $chus = $chus + intval($review->getAttributeTranslate('polite'));
}
if($revsettings->first()->getAttributeTranslate('is_cleanness') && $review->getAttributeTranslate('cleanness')){
    $znam = $znam + 1;
}
if($revsettings->first()->getAttributeTranslate('is_сosiness') && $review->getAttributeTranslate('сosiness')){
    $znam = $znam + 1;
}
if($revsettings->first()->getAttributeTranslate('is_location') && $review->getAttributeTranslate('location')){
    $znam = $znam + 1;
}
if($revsettings->first()->getAttributeTranslate('is_food') && $review->getAttributeTranslate('food')){
    $znam = $znam + 1;
}
if($revsettings->first()->getAttributeTranslate('is_wifi') && $review->getAttributeTranslate('wifi')){
    $znam = $znam + 1;
}
if($revsettings->first()->getAttributeTranslate('is_price_quality') && $review->getAttributeTranslate('price_quality')){
    $znam = $znam + 1;
}
if($revsettings->first()->getAttributeTranslate('is_family_hotel') && $review->getAttributeTranslate('family_hotel')){
    $znam = $znam + 1;
}
if($revsettings->first()->getAttributeTranslate('is_rest_children') && $review->getAttributeTranslate('rest_children')){
    $znam = $znam + 1;
}
if($revsettings->first()->getAttributeTranslate('is_young') && $review->getAttributeTranslate('young')){
    $znam = $znam + 1;
}
if($revsettings->first()->getAttributeTranslate('is_polite') && $review->getAttributeTranslate('polite')){
    $znam = $znam + 1;
}
if($znam !== 0){
    $raty = round($chus / $znam, 0, PHP_ROUND_HALF_UP);
}

@endphp
{{--{ $raty }}--}}
@if($raty !== 0)
    @for ($i = 0; $i < $raty; $i++)
        <i class="fas fa-star color-ff8c00 font-12"></i>
    @endfor
    @for ($i = 0; $i < 5 - $raty; $i++)
        <i class="far fa-star color-ff8c00 font-12"></i>
    @endfor
@endif


