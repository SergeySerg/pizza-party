@extends('ws-app')
@section('content')
    <div class="reducer">
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col tac">
                <h1>Отзывы</h1>
            </div>
        </div>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="tac">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_feedback">Добавить отзыв</button>
                </div>
                <div class="feedback_form_block hidden">
                    <form action="" id="%ID%_form">
                        <h2>Оставьте ваш отзыв</h2>
                        <div class="%CLASS%-textfield %CLASS%-js-textfield %CLASS%-textfield--floating-label">
                            <input class="%CLASS%-textfield__input" type="text" id="%ID%_name">
                            <label class="%CLASS%-textfield__label" for="%ID%_name">Имя*</label>
                        </div>
                        <div class="%CLASS%-textfield %CLASS%-js-textfield %CLASS%-textfield--floating-label">
                            <textarea class="%CLASS%-textfield__input" type="text" rows="3" id="%ID%_msg"></textarea>
                            <label class="%CLASS%-textfield__label" for="%ID%_msg">Отзыв*</label>
                        </div>
                        <div>
                            <input type="submit" value="Отправить" class="%CLASS%-button %CLASS%-js-button %CLASS%-button--raised %CLASS%-button--colored" disabled id="%ID%_btn">
                            <div class="%CLASS%-spinner %CLASS%-spinner--single-color %CLASS%-js-spinner is-active hidden" id="%ID%_loader"></div>
                        </div>
                    </form>
                    <div id="%ID%_form_done" class="hidden">
                        <h2>Спасибо!</h2>
                        <p>Ваш отзыв добавлен!</p>
                    </div>
                </div>
                <div class="feedback_list">
                    <script>
                    var feedback_paged = 1;
                    </script>
                    <div class="feedback_block">
                        <h3>Олександра</h3>
                        <div class="feedback_date">18.10.2018</div>
                        <div class="feedback_text">Замовляли 4 піцци:Паперони,Гавайская,Салями,Баварская. Мені і колегам все сподобалося,було дуже смачно і головне вчасно. Дякуємо)</div>
                        <div class="feedback_answer">
                            <strong>Менеджер Ольга</strong>
                            <p>Доброго дня! Дякуємо за залишений Вами відгук), дуже приємно що Вам сподобався смак ношої піцци.Будем раді Вашим замовленням.</p>
                        </div>
                    </div>
                    <div class="feedback_block">
                        <h3>Виктор</h3>
                        <div class="feedback_date">18.10.2018</div>
                        <div class="feedback_text">Заказал сегодня две пиццы , гавайскую и тунец, гавайская очень вкусная, тунец не понравилась , такое чувство что пицца с тунцом не совсем свежая, резкий запах и отвратительный вкус....</div>
                        <div class="feedback_answer">
                            <strong>Менеджер Ольга</strong>
                            <p>Здравствуйте Виктор,приятно что гавайская пицца Вам понравилась),а пицца с тунцом и с морепродуктами,к сожалению, всегда имеет свой специфический вкус и запах.По поводу свежести, лично проверяла, тунец свежий,только не всегда одинаковый тунец приезжает от поставщика, боремся с этим(</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pgn">
        </div>
    </div>
@endsection