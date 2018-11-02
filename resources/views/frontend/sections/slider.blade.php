<div class="slider-class">
    
    @if(!$subdomain)
        @foreach($slides as $slide)
            @if($slide->getAttributeTranslate('show_main_page') == 1)
                <div class="fullscreen-img d-flex align-items-center justify-content-center" style="background-image: url('{{ asset( $slide->getAttributeTranslate('slide_img')) }}')">
                    <h1 class="text-uppercase">                   
                        {!! str_limit($slide->getTranslate('short_description'), 100) !!}
                    </h1>                
                </div>
            @endif
        @endforeach 
    @else 
        @foreach($children_slides as $slide)        
            <div class="fullscreen-img d-flex align-items-center justify-content-center" style="background-image: url('{{ asset( $slide->getAttributeTranslate('slide_img')) }}')">
                <h1 class="text-uppercase">
                {!! str_limit($slide->getTranslate('short_description'), 100) !!}
                </h1>                
            </div>
        @endforeach
    @endif               
</div>
<nav class="main-dots d-flex justify-content-center"></nav>
    <div id="p-arrow">
        <div class="arrow-left main-arrow-left">
            <div></div>
            <div></div>
        </div>
    </div>
    <div id="n-arrow">
        <div class="arrow-right main-arrow-right">
            <div></div>
            <div></div>
        </div>
    </div>