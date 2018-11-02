@if(isset($marketings) AND count($marketings) !== 0 AND $categories_data['marketings']->active == 1)
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col padding-0">
                <h2 class="section-header-huge">{{ $categories_data['marketings']->getTranslate('title')}}</h2>
                <div class="section-description">{!! $categories_data['marketings']->getTranslate('short_description') !!}</div>
                <div class="rest-slider px-3">
                    @if(!$subdomain)
                        @foreach($marketings as $marketing)                        
                            @if($marketing->getAttributeTranslate('show_main_page') AND $marketing->getAttributeTranslate('show_main_page') == 1)
                                <div class="pt-4">
                                <div class="rest-image" style="background: url('{{ asset( $marketing->getAttributeTranslate('marketing_img')) }}')">
                                        <div class="left-click"></div>
                                        <div class="right-click"></div>
                                    </div>
                                    <div class="rest-details">
                                        <h4 class="text-uppercase">{{ $marketing->getTranslate('title')}}</h4>
                                        {!! $marketing->getTranslate('short_description') !!}                       
                                    </div>
                                </div> 
                            @endif                    
                        @endforeach                   
                    @else
                        @if(isset($children_marketings) AND $children_marketings)
                            @foreach($children_marketings as $marketing)                       
                                <div class="pt-4">
                                <div class="rest-image" style="background: url('{{ asset( $marketing->getAttributeTranslate('marketing_img')) }}')">
                                        <div class="left-click"></div>
                                        <div class="right-click"></div>
                                    </div>
                                    <div class="rest-details">
                                        <h4 class="text-uppercase">{{ $marketing->getTranslate('title')}}</h4>
                                        {!! $marketing->getTranslate('short_description') !!}                       
                                    </div>
                                </div> 
                            @endforeach 
                        @endif
                    @endif
                    
                </div>
                <nav class="rest-dots"></nav>
            </div>
        </div>
    </div>   
    @endif  