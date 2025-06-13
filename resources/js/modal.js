//銃モダル要素
const modal = document.getElementById('static-modal');
//銃モダルオープン時のグレー背景
const modalBackdrop = document.getElementById('modal_backdrop');

//銃モダルを開く
window.OpenGunModal =function (e) {

    // モーダルを表示
    modal.classList.remove('hidden');
    // バックドロップを表示
    modalBackdrop.classList.remove('hidden');

    // e.currentTargetで<button>要素を取得。
    let data = JSON.parse(e.currentTarget.getAttribute("data-gun"));//itemsテーブル
    let gunDetail = JSON.parse(e.currentTarget.getAttribute("data-gun-detail"));//gun_detailsテーブル
    let category = JSON.parse(e.currentTarget.getAttribute("data-category"));//categoriesテーブル

    // 以下、モダルに表示する内容を設定

    // 品名とモデル
    const modalTitle = document.getElementById('modal_title');
    if (gunDetail.model == null) {
        modalTitle.textContent = `品名：${data.name} / モデル：お問合せ下さい`;
    } else {
        modalTitle.textContent = `品名：${data.name} / モデル：${gunDetail.model}`;
    }
    //画像
    const modalImage = document.getElementById('modal_image');
    const baseUrl = modalImage.getAttribute("data-base-url");//asset関数後のベースURL
    if (gunDetail.image == null) {
        modalImage.classList.add('hidden');
        // document.getElementById('image_not_exist').classList.remove('hidden');
    } else {
        document.getElementById('image_not_exist').classList.add('hidden');
        modalImage.classList.remove('hidden');
        modalImage.src = `${baseUrl}/${data.id}/${gunDetail.image}`;
    }
    // カテゴリー
    const modalCategory = document.getElementById('modal_category');
    modalCategory.textContent = category.name;
    // 生産国
    const modalCountry = document.getElementById('modal_country');
    if(gunDetail.country == null){
        modalCountry.textContent = 'お問合せ下さい';
    } else {
        modalCountry.textContent = gunDetail.country;
    }
    // 料金
    const modalPrice = document.getElementById('modal_price');
    if (data.price == null) {
        modalPrice.textContent = 'お問合せ下さい';
    } else{
        modalPrice.textContent = `￥${data.price.toLocaleString()}`;
    }
    // ブランド
    const modalBrand = document.getElementById('modal_brand');
    if(gunDetail.brand == null){
        modalBrand.textContent = 'お問合せ下さい';
    } else {
        modalBrand.textContent = gunDetail.brand;
    }
    // 全長
    const modalFullLength = document.getElementById('modal_full_length');
    modalFullLength.textContent = gunDetail.full_length;
    // 総重量
    const modalFullWeight = document.getElementById('modal_full_weight');
    modalFullWeight.textContent = gunDetail.full_weight;
    // 口径
    const modalDiameter = document.getElementById('modal_diameter');
    modalDiameter.textContent = gunDetail.diameter;
    // 在庫
    const modalStock = document.getElementById('modal_is_stock');
    if (data.is_stock == 1) {
        modalStock.textContent = '在庫有';
        modalStock.classList.remove('text-red-500');
        modalStock.classList.add('text-green-600');
    } else{
        modalStock.textContent = '在庫無';
        modalStock.classList.remove('text-green-600');
        modalStock.classList.add('text-red-500');
    }
    // 備考
    const modalNote = document.getElementById('modal_note');
    if (data.note == null) {
        modalNote.textContent = '';
    } else {
        modalNote.textContent = data.note;
    }
}

//銃モダルを閉じる
window.CloseGunModal = function (){
    modal.classList.add('hidden');  // モーダルを非表示
    modalBackdrop.classList.add('hidden');  // バックドロップを非表示
}

//弾とその他のモダル要素
const bulletOtherModal = document.getElementById('bullet_other_modal');
// 弾とその他のモダルオープン時のグレー背景
const bulletOtherModalBackdrop = document.getElementById('bullet_other_modal_backdrop');

window.OpenBulletOtherModal =function (e) {
    // モーダルを表示
    bulletOtherModal.classList.remove('hidden');
    // バックドロップを表示
    bulletOtherModalBackdrop.classList.remove('hidden');

    // e.currentTargetで<button>要素を取得。
    let data = JSON.parse(e.currentTarget.getAttribute("data-item"));//itemsテーブル
    let category = JSON.parse(e.currentTarget.getAttribute("data-category"));//categoriesテーブル

    // 品名とモデル
    const modalTitle = document.getElementById('bullet_other_modal_title');
    modalTitle.textContent = `品名：${data.name}`;
    // カテゴリー
    const modalCategory = document.getElementById('bullet_other_modal_category');
    modalCategory.textContent = category.name;
    // 料金
    const modalPrice = document.getElementById('bullet_other_modal_price');
    if (data.price == null) {
        modalPrice.textContent = 'お問合せ下さい';
    } else{
        modalPrice.textContent = `￥${data.price.toLocaleString()}`;
    }
    // 在庫
    const modalStock = document.getElementById('bullet_other_modal_is_stock');
    if (data.is_stock == 1) {
        modalStock.textContent = '在庫有';
        modalStock.classList.remove('text-red-500');
        modalStock.classList.add('text-green-600');
    } else{
        modalStock.textContent = '在庫無';
        modalStock.classList.remove('text-green-600');
        modalStock.classList.add('text-red-500');
    }
    // 備考
    const modalNote = document.getElementById('bullet_other_modal_note');
    if (data.note == null) {
        modalNote.textContent = '';
    } else {
        modalNote.textContent = data.note;
    }
}
//弾とその他モダルを閉じる
window.CloseBulletOtherModal = function (){
    bulletOtherModal.classList.add('hidden');  // モーダルを非表示
    bulletOtherModalBackdrop.classList.add('hidden');  // バックドロップを非表示
}
