<?php
/**
 * Created by PhpStorm.
 * User: td779
 * Date: 05.12.2019
 * Time: 22:43
 */


$this->title = 'Плеяда - оформити замовлення';
?>

<div class="order-container">
    <h2 class="title-h2 center">Оформити замовлення</h2>
    <div class="order-info">
        <form action="#" method="post" class="order-form">
            <input type="text" name="pib" placeholder="Прізвище Ім'я По батькові...">
            <input type="text" name="number" placeholder="+38(0__) __ __ ___">
            <input type="text" name="email" placeholder="Email...">
            <select name="city">
                <option>Виберіть місто...</option>
                <option value="Луцьк">Луцьк</option>
                <option value="Львів">Львів</option>
                <option value="Київ">Київ</option>
            </select>
            <textarea name="comment" cols="30" rows="5" placeholder="Ваш коментар до замовлення...">
						</textarea>
            <input type="submit" value="Замовити">
        </form>
        <div class="order-goods">
            <div class="one-click">
                <div>
                    <p>Бажаєтее оформити замовлення в один клік?</p>
                    <p>Залиште свій номер телефону, по якому наш менеджер зв'яжеться з Вами для оформлення покупки</p>
                </div>
                <div class="click-separator"></div>
                <div>
                    <form action="" method="post" class="one-clock-form">
                        <input type="text" name="number" placeholder="+38(0__) __ __ ___">
                        <input type="submit" value="OK">
                    </form>
                </div>
            </div>
            <div class="curt-products order-products">
                <div class="curt-product">
                    <div class="curt-close">✖</div>
                    <img src="/img/penal.png" alt="Пенал" align="200" height="200">
                    <div class="curt-description">
                        <div class="curt-info-title">
                            <a href="#" class="curt-product-name">
                                Пенал з наповненням Herlitz Pretty Pets Horse 19 предметів 1 відділення рожевий (8229270H)
                            </a>
                            <span>Сумма</span>
                        </div>
                        <div class="curt-info-body">
										<span class="curt-price">
											0 000 грн
										</span>
                            <div class="curt-counter">
                                <span class="curn-symbols curt-minus">-</span>
                                <span class="curn-number-products">1</span>
                                <span class="curn-symbols curt-plus">+</span>
                            </div>
                            <span class="curt-summary-price">
											0 000 грн
										</span>
                        </div>
                    </div>
                </div>
                <div class="curt-product">
                    <div class="curt-close">✖</div>
                    <img src="/img/penal2.png" alt="Пенал" align="200" height="200">
                    <div class="curt-description">
                        <div class="curt-info-title">
                            <a href="#" class="curt-product-name">
                                Пенал з наповненням Herlitz Pretty Pets Horse 19 предметів 1 відділення рожевий (8229270H)
                            </a>
                            <span>Сумма</span>
                        </div>
                        <div class="curt-info-body">
										<span class="curt-price">
											0 000 грн
										</span>
                            <div class="curt-counter">
                                <span class="curn-symbols curt-minus">-</span>
                                <span class="curn-number-products">1</span>
                                <span class="curn-symbols curt-plus">+</span>
                            </div>
                            <span class="curt-summary-price">
											0 000 грн
										</span>
                        </div>
                    </div>
                </div>
                <div class="curt-product">
                    <div class="curt-close">✖</div>
                    <img src="/img/penal.png" alt="Пенал" align="200" height="200">
                    <div class="curt-description">
                        <div class="curt-info-title">
                            <a href="#" class="curt-product-name">
                                Пенал з наповненням Herlitz Pretty Pets Horse 19 предметів 1 відділення рожевий (8229270H)
                            </a>
                            <span>Сумма</span>
                        </div>
                        <div class="curt-info-body">
										<span class="curt-price">
											0 000 грн
										</span>
                            <div class="curt-counter">
                                <span class="curn-symbols curt-minus">-</span>
                                <span class="curn-number-products">1</span>
                                <span class="curn-symbols curt-plus">+</span>
                            </div>
                            <span class="curt-summary-price">
											0 000 грн
										</span>
                        </div>
                    </div>
                </div>
                <div class="curt-total">
                    <div class="curt-total-info">
                        <span>Всього:</span>
                        <span>0 000 грн</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
