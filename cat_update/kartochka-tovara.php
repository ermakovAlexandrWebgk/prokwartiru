<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>

<div class="product_wrapper">

    <div class="product_main_info">

        <div class="image_block prod_left_block">
            <div class="images_container">
                <img src="/upload/resize_cache/iblock/2de/400_400_140cd750bba9870f18aada2478b24840a/2dea587a849834d90b973f7d52ac432f.jpg" alt="">
                <div class="imagers_preview">

                </div>
            </div>
        </div>

        <div class="product_info_wrapper">

            <div class="product_title"> Артикул: 5540</div>
            <div class="product_description"> Классические обои, производство Германии.</div>
            <div class="product_size"> <span class="red_text"> Размер:</span> длина: 10,05 м | ширина: 0,7 м | раппорт: 0,13 м </div>
            <div class="product_price">
                <p>
                    Цена: <input type="text" name="" value="4490 руб" readonly> x <input type="text" name="" value="1 рулон">  = <input type="text" name="" value="4490 руб">
                </p>
                <button type="button" name="button">Получить скидку</button>
            </div>
            <div class="product_buttons">
                <button type="button" name="button">Добавить в избранное</button>
                <button type="button" name="button">Клей</button>
                <button type="button" name="button">В корзину</button>
                <button type="button" name="button">Монтажная инструкция</button>
            </div>

            <p>Аналоги</p>

            <div class="imagers_preview">

            </div>
            <p>Компаньоны</p>
            <div class="imagers_preview">

            </div>
            <p>Другой цвет</p>
            <div class="imagers_preview">

            </div>



        </div>

    </div>

    <div class="personal_recommendation">

    </div>

</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

<style media="screen">
    .product_wrapper{
        width: 100%;
        color: #5d504a;
    }
    .product_main_info{
        width: 100%;
        display: flex;
        flex-direction: row;

    }

    .product_wrapper div {
        box-sizing: border-box;
    }

    .product_wrapper .image_block{
        background: rgba(0,255,0,0.2);
    }
    .product_wrapper .image_block .images_container{
        background: rgba(0,255,0,0.2);
        width: 100%;
        position: sticky;
        top: 0;
        bottom: 0;
        padding: 92px 30px 30px;

    }
    .product_wrapper .image_block .images_container img{
        background: rgba(0,255,0,0.2);
        width: 100%;


    }
    .product_wrapper .image_block .images_container .imagers_preview, .product_wrapper .product_info_wrapper .imagers_preview{
        background: rgba(255,0,0,0.2);
        width: 100%;
        margin-top: 20px;
        height: 120px;

    }
    .product_wrapper .product_info_wrapper{
        width: 50%;
        background: rgba(0,0,255,0.2);
    }
    .product_wrapper .product_info_wrapper div{
        background: rgba(0,0,255,0.2);
        /* font-size: 1.2em; */
        font-weight: bold;
        margin-bottom: 30px;
    }
    .product_wrapper .product_info_wrapper .product_title{
        background: rgba(0,0,255,0.2);
    }
    div.product_price input[type="text"] {
        width: 85px;
        padding: 1px;
        line-height: 15px;
        border: 1px solid #909090;
        border-radius: 0;
    }
    div.product_price p {
        margin: 0 0 5px;
    }
    div.product_price button {
        width: 130px;
        height: 22px;
        padding: 1px;
        line-height: 15px;
        border: 1px solid #ec6b06;
        border-radius: 0;
        text-align: center;
    }
    .product_wrapper .product_info_wrapper .product_buttons {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .product_wrapper .product_info_wrapper .product_buttons button{
        width: 45%;
        margin-bottom: 30px;
        height: 30px;
        border: 2px solid #ec6b06;
        line-height: 20px;

    }

    .personal_recommendation{
        background: rgba(255,0,0,0.2);
        width: 100%;
        height: 400px;
    }
</style>
