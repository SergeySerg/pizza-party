@extends('ws-app')
@section('content')
    <article id="post-6" class="post-6 page type-page status-publish hentry">
        <div class="reducer">
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col tac">
                    <h1 class="entry-title">{{ trans('base.backet')}}</h1>
                </div>
            </div>
            <div class="mdl-grid" id="order_process">
                <div class="mdl-cell mdl-cell--4-col cart_form">
                    <form action="#" id="order_form">
                        {{--<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="cart_code">
                            <label class="mdl-textfield__label" for="cart_code">Скидочный код</label>
                        </div>--}}
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" name='name' type="text" id="cart_name">
                            <label class="mdl-textfield__label" for="cart_name">Имя *</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" name='phone' id="cart_phone">
                            <label class="mdl-textfield__label" for="cart_phone">Телефон *</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" name='address' id="cart_address">
                            <label class="mdl-textfield__label" for="cart_address">Адрес</label>
                        </div>
                        {{--<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="cart_email">
                            <label class="mdl-textfield__label" for="cart_email">Эл. почта</label>
                        </div>--}}
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <textarea class="mdl-textfield__input" type="text" name='short_description' rows="3" id="cart_note"></textarea>
                            <label class="mdl-textfield__label" for="cart_note">Примечание</label>
                        </div>
                        <div>
                            <input type="submit" value="Отправить заказ" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" disabled id="order_btn">
                            <div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active hidden" id="order_loader"></div>
                        </div>
                    </form>
                </div>
                <div class="mdl-cell mdl-cell--8-col">
                    <table class="mdl-data-table full_width cart_table">
                        <tbody>
                            {{--<tr id="cart_row_117_400">
                                <td class="mdl-data-table__cell--non-numeric cart_img">
                                    <div class="cart_img_block" style="background: url('/images/salyami-pizza-300x300.jpg') 50% 50% no-repeat;-webkit-background-size: contain;background-size: contain;"></div>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric cart_product">
                                    <h3>Салями</h3>
                                    томатный соус, салями, моцарелла
                                </td>
                                <td class="cart_break"></td>
                                <td data-id="117" class="mdl-data-table__cell--non-numeric cart_info_td"><span>32 см</span> <span>400 гр</span> </td>
                                <td class="mdl-data-table__cell--non-numeric cart_num_td">
                                    <div class="cart_num" data-id="117" data-weight="400">
                                        <div class="cart_num_plus">
                                            <button class="mdl-button mdl-js-button mdl-button--icon cart_num_plus_btn">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                        <div class="cart_num_curr">1</div>
                                        <div class="cart_num_minus">
                                            <button class="mdl-button mdl-js-button mdl-button--icon cart_num_minus_btn">
                                                <i class="material-icons">remove</i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric cart_price_td">
                                    <span>
                                        <span class="price" id="cart_price_117_400">134</span> грн
                                    </span>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric cart_delete_td">
                                    <button class="mdl-button mdl-js-button mdl-button--icon cart_remove_btn" data-id="117" data-weight="400">
                                        <i class="material-icons">clear</i>
                                    </button>
                                </td>
                            </tr>
                            <tr id="cart_row_124_190">
                                <td class="mdl-data-table__cell--non-numeric cart_img">
                                    <div class="cart_img_block" style="background: url('/images/cezar.jpg') 50% 50% no-repeat;-webkit-background-size: contain;background-size: contain;"></div>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric cart_product">
                                    <h3>Цезарь</h3>
                                    яйцо, микс салата, соус «цезарь», помидор, пармезан, курица-гриль, бекон
                                </td>
                                <td class="cart_break"></td>
                                <td data-id="124" class="mdl-data-table__cell--non-numeric cart_info_td"><span>190 гр</span> </td>
                                <td class="mdl-data-table__cell--non-numeric cart_num_td">
                                    <div class="cart_num" data-id="124" data-weight="190">
                                        <div class="cart_num_plus">
                                            <button class="mdl-button mdl-js-button mdl-button--icon cart_num_plus_btn">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                        <div class="cart_num_curr">1</div>
                                        <div class="cart_num_minus">
                                            <button class="mdl-button mdl-js-button mdl-button--icon cart_num_minus_btn">
                                                <i class="material-icons">remove</i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric cart_price_td">
                                    <span>
                                        <span class="price" id="cart_price_124_190">89</span> грн
                                    </span>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric cart_delete_td">
                                    <button class="mdl-button mdl-js-button mdl-button--icon cart_remove_btn" data-id="124" data-weight="190">
                                        <i class="material-icons">clear</i>
                                    </button>
                                </td>
                            </tr>
                            <tr id="cart_row_128_110">
                                <td class="mdl-data-table__cell--non-numeric cart_img">
                                    <div class="cart_img_block" style="background: url('/images/panna-kotta.jpg') 50% 50% no-repeat;-webkit-background-size: contain;background-size: contain;"></div>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric cart_product">
                                    <h3>Панна-Котта</h3>
                                </td>
                                <td class="cart_break"></td>
                                <td data-id="128" class="mdl-data-table__cell--non-numeric cart_info_td"><span>110 гр</span> </td>
                                <td class="mdl-data-table__cell--non-numeric cart_num_td">
                                    <div class="cart_num" data-id="128" data-weight="110">
                                        <div class="cart_num_plus">
                                            <button class="mdl-button mdl-js-button mdl-button--icon cart_num_plus_btn">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                        <div class="cart_num_curr">1</div>
                                        <div class="cart_num_minus">
                                            <button class="mdl-button mdl-js-button mdl-button--icon cart_num_minus_btn">
                                                <i class="material-icons">remove</i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric cart_price_td">
                                    <span>
                                        <span class="price" id="cart_price_128_110">39</span> грн
                                    </span>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric cart_delete_td">
                                    <button class="mdl-button mdl-js-button mdl-button--icon cart_remove_btn" data-id="128" data-weight="110">
                                        <i class="material-icons">clear</i>
                                    </button>
                                </td>
                            </tr>
                            <tr id="cart_row_132_0-5">
                                <td class="mdl-data-table__cell--non-numeric cart_img">
                                    <div class="cart_img_block" style="background: url('/images/fanta.jpg') 50% 50% no-repeat;-webkit-background-size: contain;background-size: contain;"></div>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric cart_product">
                                    <h3>Фанта</h3>
                                </td>
                                <td class="cart_break"></td>
                                <td data-id="132" class="mdl-data-table__cell--non-numeric cart_info_td"><span>0.5 л</span> <span>1 л</span> </td>
                                <td class="mdl-data-table__cell--non-numeric cart_num_td">
                                    <div class="cart_num" data-id="132" data-weight="0.5">
                                        <div class="cart_num_plus">
                                            <button class="mdl-button mdl-js-button mdl-button--icon cart_num_plus_btn">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                        <div class="cart_num_curr">1</div>
                                        <div class="cart_num_minus">
                                            <button class="mdl-button mdl-js-button mdl-button--icon cart_num_minus_btn">
                                                <i class="material-icons">remove</i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric cart_price_td">
                                    <span>
                                        <span class="price" id="cart_price_132_0-5">25</span> грн
                                    </span>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric cart_delete_td">
                                    <button class="mdl-button mdl-js-button mdl-button--icon cart_remove_btn" data-id="132" data-weight="0.5">
                                        <i class="material-icons">clear</i>
                                    </button>
                                </td>
                            </tr>
                            <tr id="cart_row_130_1">
                                <td class="mdl-data-table__cell--non-numeric cart_img">
                                    <div class="cart_img_block" style="background: url('/images/coca-colla.jpg') 50% 50% no-repeat;-webkit-background-size: contain;background-size: contain;"></div>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric cart_product">
                                    <h3>Кока-кола</h3>
                                </td>
                                <td class="cart_break"></td>
                                <td data-id="130" class="mdl-data-table__cell--non-numeric cart_info_td"><span>0.5 л</span> <span>1 л</span> </td>
                                <td class="mdl-data-table__cell--non-numeric cart_num_td">
                                    <div class="cart_num" data-id="130" data-weight="1">
                                        <div class="cart_num_plus">
                                            <button class="mdl-button mdl-js-button mdl-button--icon cart_num_plus_btn">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                        <div class="cart_num_curr">1</div>
                                        <div class="cart_num_minus">
                                            <button class="mdl-button mdl-js-button mdl-button--icon cart_num_minus_btn">
                                                <i class="material-icons">remove</i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric cart_price_td">
                                    <span>
                                        <span class="price" id="cart_price_130_1">50</span> грн
                                    </span>
                                </td>
                                <td class="mdl-data-table__cell--non-numeric cart_delete_td">
                                    <button class="mdl-button mdl-js-button mdl-button--icon cart_remove_btn" data-id="130" data-weight="1">
                                        <i class="material-icons">clear</i>
                                    </button>
                                </td>
                            </tr>--}}
                        </tbody>
                    </table>
                    <div class="cart_totals">
                        Всего <span class="cart_totals_price">337</span> грн
                        <p>Доставка бесплатно</p>
                    </div>
                </div>
            </div>

            <div class="mdl-grid hidden" id="order_empty">
                <div class="mdl-cell mdl-cell--12-col">
                    <h1 class="entry-title">{{ trans('base.backet')}}</h1>
                    <p>В корзине нет товаров.</p>
                    <p><a href="/">Вернуться к покупкам</a></p>
                </div>
            </div>

            <div class="mdl-grid hidden" id="order_done">
                <div class="mdl-cell mdl-cell--12-col">
                    <h1>Ваш заказ принят!</h1>
                    <h3>И уже почти отправлен.</h3>
                    <p>Спасибо что доверились нам. Мы не подведём!</p>
                    <p>Оператор перезвонит вам в течении 5, максимум 10 минут для подтверждения. Если этого не произошло, значит ваш заказ до нас не дошел, либо мы не можем вам дозвониться.</p>
                    <p>Ваш номер телефона <span id="order_done_phone"></span>. Проверьте чтобы он был включен, и вы могли его услышать.</p>
                    <p>Без подтверждения мы не сможет приготовить и отправить ваш заказ, по этому огромная просьба, если вдруг мы не смогли с вами свзаться перезвонить нам на номер 227-22-66, для уточнения.</p>
                </div>
            </div>
        </div>
    </article>
@endsection