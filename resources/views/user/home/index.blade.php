@extends('user.layout.app')

@section('title','Home')

@section('content')


<style>
.hero-section {
    background: #013e37;
    padding: 70px 60px 0;
    display: flex;
    align-items: flex-end;
    gap: 50px;
    min-height: 480px;
    position: relative;
    overflow: hidden;
}
.hero-section::before {
    content: '';
    position: absolute;
    width: 400px; height: 400px;
    border-radius: 50%;
    border: 1.5px solid rgba(255,239,179,.07);
    top: -150px; right: 180px;
    pointer-events: none;
}
.hero-section::after {
    content: '';
    position: absolute;
    width: 220px; height: 220px;
    border-radius: 50%;
    border: 1.5px solid rgba(255,239,179,.07);
    top: -60px; right: 260px;
    pointer-events: none;
}

.search-box{
    width:200px;
    height:48px;
    border-radius:30px;
    border:2px solid #ffe8a3;
    padding:0 20px;
}

/* ---- Left ---- */
.hero-left {
    flex: 1;
    max-width: 500px;
    padding-bottom: 70px;
    position: relative;
    z-index: 2;
}
.hero-tag {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(255,239,179,.1);
    border: 1px solid rgba(255,239,179,.2);
    border-radius: 20px;
    padding: 6px 14px;
    margin-bottom: 22px;
}
.hero-tag .htag-dot {
    width: 7px; height: 7px;
    background: #4ade80;
    border-radius: 50%;
    animation: blink 1.6s infinite;
}
@keyframes blink {
    0%, 100% { opacity: 1; }
    50%       { opacity: .4; }
}
.hero-tag span { font-size: 12.5px; color: #ffefb3; font-weight: 500; }

.hero-section h1 {
    font-size: 46px;
    font-weight: 800;
    color: #ffefb3;
    line-height: 1.1;
    margin-bottom: 16px;
    letter-spacing: -.5px;
}
.hero-section h1 .dim { color: rgba(255,239,179,.4); }

.hero-desc {
    font-size: 15.5px;
    color: rgba(255,239,179,.6);
    line-height: 1.7;
    margin-bottom: 30px;
    max-width: 400px;
}

.hero-btns { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }

.btn-hero-main {
    background: #ffefb3;
    color: #013e37;
    font-weight: 700;
    font-size: 14.5px;
    padding: 13px 26px;
    border-radius: 9px;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    transition: .15s;
    cursor: pointer;
}
.btn-hero-main:hover {
    background: #ffe98a;
    color: #013e37;
    transform: translateY(-1px);
}
.btn-hero-ghost {
    background: transparent;
    color: #ffefb3;
    border: 1.5px solid rgba(255,239,179,.3);
    font-weight: 600;
    font-size: 14.5px;
    padding: 13px 24px;
    border-radius: 9px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    transition: .15s;
}
.btn-hero-ghost:hover {
    border-color: rgba(255,239,179,.7);
    background: rgba(255,239,179,.07);
    color: #ffefb3;
}

.hero-cat-chips { display: flex; gap: 8px; margin-top: 28px; flex-wrap: wrap; }
.hero-cat-chips .chip {
    background: rgba(255,239,179,.08);
    border: 1px solid rgba(255,239,179,.18);
    border-radius: 20px;
    padding: 5px 13px;
    font-size: 12.5px;
    color: rgba(255,239,179,.7);
    text-decoration: none;
    transition: .15s;
}
.hero-cat-chips .chip:hover {
    background: rgba(255,239,179,.15);
    color: #ffefb3;
}

/* ---- Right ---- */
.hero-right {
    flex-shrink: 0;
    width: 400px;
    position: relative;
    z-index: 2;
    align-self: flex-end;
}

.hero-float-chip {
    position: absolute;
    background: #fff;
    border-radius: 11px;
    padding: 10px 14px;
    display: flex;
    align-items: center;
    gap: 9px;
    box-shadow: 0 4px 20px rgba(0,0,0,.12);
    z-index: 4;
    white-space: nowrap;
}
.hero-float-chip.top    { top: 20px;    right: -12px; }
.hero-float-chip.bottom { bottom: 80px; left: -24px;  }

.hfc-ico {
    width: 32px; height: 32px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px;
}
.hfc-ico.green  { background: #dcfce7; }
.hfc-ico.yellow { background: #fef3c7; }
.hfc-name { font-size: 12px; font-weight: 700; color: #013e37; }
.hfc-sub  { font-size: 10.5px; color: #999; margin-top: 1px; }

/* Products card */
.hero-products-card {
    background: #fff;
    border-radius: 18px 18px 0 0;
    overflow: hidden;
    box-shadow: 0 -8px 48px rgba(0,0,0,.22);
    padding: 20px;
}
.hpc-title {
    font-size: 11.5px;
    font-weight: 700;
    color: #013e37;
    letter-spacing: .4px;
    text-transform: uppercase;
    margin-bottom: 14px;
}
.hpc-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}
.hpc-item {
    background: #f9f9f6;
    border-radius: 10px;
    padding: 10px 8px;
    text-align: center;
    border: 1px solid #eee;
    transition: .15s;
}
.hpc-item:hover { border-color: #013e37; transform: translateY(-2px); }
.hpc-item .emo  { font-size: 24px; display: block; margin-bottom: 6px; }
.hpc-item .name { font-size: 10px; font-weight: 600; color: #013e37; margin-bottom: 3px; }
.hpc-item .price { font-size: 11px; color: #f97316; font-weight: 700; }

/* ---- Wave divider ---- */
.hero-wave {
    background: #013e37;
    line-height: 0;
    display: block;
}
.hero-wave svg { display: block; width: 100%; }

/* ---- Category strip ---- */
.category-strip {
    background: #ffefb3;
    padding: 32px 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}
.cstrip-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    text-decoration: none;
    min-width: 72px;
}
.cstrip-ico {
    width: 54px; height: 54px;
    border-radius: 14px;
    background: #013e37;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
    transition: .15s;
}
.cstrip-item:hover .cstrip-ico {
    background: #025249;
    transform: translateY(-3px);
}
.cstrip-lbl {
    font-size: 12px;
    font-weight: 700;
    color: #013e37;
}
.category-section{
    padding:70px 0 20px;
}

.category-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:35px;
}

.category-title{
    font-size:32px;
    font-weight:700;
    color:#013e37;
    position:relative;
}

.category-title::after{
    content:'';
    width:70px;
    height:4px;
    background:#013e37;
    position:absolute;
    left:0;
    bottom:-10px;
    border-radius:20px;
}

.view-more{
    color:#013e37;
    font-weight:600;
    text-decoration:none;
    transition:.3s;
}

.view-more:hover{
    color:#0b6a5f;
}


.btn-cart{
    width:100%;
    background:#0b4d45;
    color:#fff;
    border:none;
    border-radius:10px;
    padding:10px;
    font-weight:600;
    transition:.3s;
}

.btn-cart:hover{
    background:#0f665b;
    transform:translateY(-2px);
}

.btn-cart i{
    margin-right:6px;
}

/* ============================================================
   GLOBAL
============================================================ */
:root {
    --green : #013e37;
    --green2: #025249;
    --cream : #ffefb3;
    --orange: #d97706;
}
.section-heading {
    text-align: center;
    margin-bottom: 40px;
}
.section-heading .dec {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-bottom: 8px;
}
.section-heading .dec::before,
.section-heading .dec::after {
    content: '';
    width: 40px; height: 2px;
    background: var(--green);
    opacity: .35;
    border-radius: 2px;
}
.section-heading h2 {
    font-size: 32px;
    font-weight: 800;
    color: var(--green);
    margin: 0;
}
.section-heading p {
    font-size: 15px;
    color: #888;
    margin: 8px 0 0;
}

/* ============================================================
   CATEGORIES SECTION
============================================================ */
.categories-section {
    background: #ffefb3;
    padding: 60px 60px 70px;
}

.cat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
    gap: 20px;
}

.cat-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    text-align: center;
    border: 1px solid rgba(1,62,55,.08);
    transition: .2s;
    cursor: pointer;
    text-decoration: none;
    display: block;
}
.cat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 28px rgba(1,62,55,.13);
}

.cat-img-wrap {
    width: 100%;
    height: 140px;
    overflow: hidden;
    position: relative;
    background: #f5f5f0;
    display: flex;
    align-items: center;
    justify-content: center;
}
.cat-img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform .3s;
}
.cat-card:hover .cat-img-wrap img {
    transform: scale(1.06);
}
.cat-img-wrap .cat-no-img {
    font-size: 42px;
}

/* emoji badge */
.cat-emoji-badge {
    position: absolute;
    bottom: -18px;
    left: 50%;
    transform: translateX(-50%);
    width: 40px; height: 40px;
    background: #fff;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    box-shadow: 0 2px 10px rgba(0,0,0,.12);
    border: 2px solid #fff;
}

.cat-body {
    padding: 28px 14px 16px;
}
.cat-name {
    font-size: 15px;
    font-weight: 700;
    color: var(--green);
    margin-bottom: 12px;
}
.btn-explore {
    background: var(--green);
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    padding: 8px 22px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: .15s;
    display: inline-block;
    text-decoration: none;
    width: 100%;
}
.btn-explore:hover {
    background: var(--green2);
    color: #fff;
}

/* ============================================================
   PRODUCTS SECTION
============================================================ */
.products-section {
    background: #ffefb3;
    padding: 60px 60px 70px;
}

.prod-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
    gap: 20px;
}

.prod-card {
    background: #fafaf8;
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid #eee;
    transition: .2s;
    text-decoration: none;
    display: block;
}
.prod-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 28px rgba(1,62,55,.1);
    border-color: rgba(1,62,55,.15);
}

.prod-img-wrap {
    width: 100%;
    height: 180px;
    overflow: hidden;
    background: #f0f0ec;
    display: flex;
    align-items: center;
    justify-content: center;
}
.prod-img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform .3s;
}
.prod-card:hover .prod-img-wrap img {
    transform: scale(1.05);
}
.prod-img-wrap .no-img {
    font-size: 48px;
    color: #ccc;
}

.prod-body {
    padding: 14px;
    text-align: center;
}
.prod-name {
    font-size: 14px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 6px;
}
.prod-price {
    font-size: 16px;
    font-weight: 800;
    color: var(--orange);
    margin-bottom: 12px;
}
.btn-order-now {
    background: var(--green);
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    padding: 9px 16px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: .15s;
}
.btn-order-now:hover { background: var(--green2); }

/* cartbutton */

.cart-btn{
    width:48px;
    height:48px;
    border-radius:50%;
    background:#ffe8a3;
    display:flex;
    justify-content:center;
    align-items:center;
    position:relative;
    text-decoration:none;
    color:#0b4d45;
    font-size:22px;
      transition:.3s;
}
.cart-btn:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 18px rgba(0,0,0,.2);
}

.cart-count{
    position:absolute;
    top:-8px;
    right:-8px;
    width:20px;
    height:20px;
    border-radius:50%;
    background:red;
    color:#fff;
    font-size:12px;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* ============================================================
   ORDER MODAL
============================================================ */
.order-modal .modal-content {
    border-radius: 16px;
    border: none;
    overflow: hidden;
}
.order-modal .modal-header {
    background: var(--green);
    padding: 18px 22px;
    border: none;
}
.order-modal .modal-title {
    color: var(--cream);
    font-weight: 700;
    font-size: 16px;
}
.order-modal .btn-close {
    filter: invert(1) sepia(1) saturate(2);
    opacity: .8;
}
.order-modal .modal-body  { padding: 22px; }
.order-modal .modal-footer { background: #fff; border-top: 1px solid #f0f0f0; padding: 14px 22px; }

.order-preview {
    display: flex; align-items: center; gap: 14px;
    background: #f8faf9;
    border-radius: 10px; padding: 12px; margin-bottom: 20px;
    border: 1px solid rgba(1,62,55,.1);
}
.order-preview img {
    width: 58px; height: 58px;
    border-radius: 9px; object-fit: cover; flex-shrink: 0;
}
.order-preview .no-img-sm {
    width: 58px; height: 58px; border-radius: 9px;
    background: #f0f0ec; display: flex; align-items: center; justify-content: center;
    font-size: 26px; flex-shrink: 0;
}
.order-preview .op-name  { font-size: 14px; font-weight: 700; color: var(--green); }
.order-preview .op-price { font-size: 13px; color: var(--orange); font-weight: 700; margin-top: 3px; }

.order-modal .form-label   { font-size: 13px; font-weight: 600; color: var(--green); }
.order-modal .form-control,
.order-modal .form-select  { border-radius: 8px; font-size: 13.5px; padding: 9px 12px; border: 1.5px solid #e0e0e0; }
.order-modal .form-control:focus,
.order-modal .form-select:focus {
    border-color: var(--green);
    box-shadow: 0 0 0 3px rgba(1,62,55,.1);
    outline: none;
}
.btn-confirm-order {
    background: var(--green); color: var(--cream);
    font-weight: 700; font-size: 14px;
    padding: 11px 28px; border-radius: 9px;
    border: none; cursor: pointer; transition: .15s;
    display: inline-flex; align-items: center; gap: 8px;
}
.btn-confirm-order:hover { background: var(--green2); }

/* ============================================================
   EMPTY STATES
============================================================ */
.empty-state {
    text-align: center;
    padding: 50px 20px;
    color: rgba(1,62,55,.4);
    font-size: 15px;
    grid-column: 1 / -1;
}
.empty-state .empty-ico { font-size: 40px; margin-bottom: 10px; }

/* ============================================================
   RESPONSIVE
============================================================ */
@media (max-width: 1024px) {
    .categories-section, .products-section { padding-left: 32px; padding-right: 32px; }
}
@media (max-width: 768px) {
    .categories-section, .products-section { padding: 40px 20px; }
    .cat-grid  { grid-template-columns: repeat(2, 1fr); }
    .prod-grid { grid-template-columns: repeat(2, 1fr); }
    .section-heading h2 { font-size: 24px; }
}
@media (max-width: 480px) {
    .cat-grid  { grid-template-columns: repeat(2, 1fr); }
    .prod-grid { grid-template-columns: repeat(2, 1fr); }
}





/* ---- Responsive ---- */
@media (max-width: 1024px) {
    .hero-section { padding: 50px 32px 0; gap: 32px; }
    .hero-section h1 { font-size: 36px; }
    .hero-right { width: 340px; }
    .category-strip { padding: 28px 32px; gap: 14px; }
}
@media (max-width: 768px) {
    .hero-section {
        flex-direction: column;
        align-items: flex-start;
        padding: 40px 20px 0;
        min-height: auto;
    }
    .hero-left { padding-bottom: 30px; }
    .hero-right { width: 100%; max-width: 400px; align-self: center; }
    .hero-section h1 { font-size: 30px; }
    .hero-float-chip { display: none; }
    .category-strip { padding: 24px 20px; gap: 12px; }
    .cstrip-ico { width: 46px; height: 46px; font-size: 18px; }
}
</style>

{{-- ====================================================
     HERO
===================================================== --}}
<section class="hero-section">

    {{-- Left Text --}}
    <div class="hero-left">

        <div class="hero-tag">
            <span class="htag-dot"></span>
            <span>New Arrivals Just Dropped!</span>
        </div>

        <h1>
            Your One-Stop<br>
            <span class="dim">Fancy</span> Store<br>
            for Everything
        </h1>

        <p class="hero-desc">
            Explore Fancy Items, Beauty Products, Stationery,
            Accessories, Gifts and so much more — all at the best prices.
        </p>

        <div class="hero-btns">
            <a href="#" class="btn-hero-main">
                🛍️ Shop Now
            </a>
            <a href="#" class="btn-hero-ghost">
                📦 View Categories
            </a>
        </div>

        <div class="hero-cat-chips">
            <a href="#" class="chip">✨ Fancy Items</a>
            <a href="#" class="chip">💄 Beauty</a>
            <a href="#" class="chip">📚 Stationery</a>
            <a href="#" class="chip">🎁 Gifts</a>
            <a href="#" class="chip">💍 Accessories</a>
        </div>

    </div>

    {{-- Right Product Mockup --}}
    <div class="hero-right">

        {{-- Floating chip - offer --}}
        <div class="hero-float-chip top">
            <div class="hfc-ico green">🎉</div>
            <div>
                <div class="hfc-name">Up to 30% Off</div>
                <div class="hfc-sub">On selected items</div>
            </div>
        </div>

        {{-- Floating chip - rating --}}
        <div class="hero-float-chip bottom">
            <div class="hfc-ico yellow">⭐</div>
            <div>
                <div class="hfc-name">500+ Happy Customers</div>
                <div class="hfc-sub">Tamil Nadu, India</div>
            </div>
        </div>

        {{-- Products card --}}
        <div class="hero-products-card">
            <div class="hpc-title">Popular Products</div>
            <div class="hpc-grid">
                <div class="hpc-item">
                    <span class="emo">💄</span>
                    <div class="name">Lipstick Set</div>
                    <div class="price">₹120</div>
                </div>
                <div class="hpc-item">
                    <span class="emo">📓</span>
                    <div class="name">Notebook</div>
                    <div class="price">₹45</div>
                </div>
                <div class="hpc-item">
                    <span class="emo">🎀</span>
                    <div class="name">Gift Box</div>
                    <div class="price">₹199</div>
                </div>
                <div class="hpc-item">
                    <span class="emo">💍</span>
                    <div class="name">Bracelet</div>
                    <div class="price">₹89</div>
                </div>
                <div class="hpc-item">
                    <span class="emo">🌸</span>
                    <div class="name">Perfume</div>
                    <div class="price">₹350</div>
                </div>
                <div class="hpc-item">
                    <span class="emo">✏️</span>
                    <div class="name">Pen Set</div>
                    <div class="price">₹60</div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ====================================================
     WAVE DIVIDER
===================================================== --}}
<div class="hero-wave">
    <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z" fill="#ffefb3"/>
    </svg>
</div>

{{-- ====================================================
     CATEGORY STRIP
===================================================== --}}
<section class="category-strip">
    <a href="#" class="cstrip-item">
        <div class="cstrip-ico">✨</div>
        <div class="cstrip-lbl">Fancy Items</div>
    </a>
    <a href="#" class="cstrip-item">
        <div class="cstrip-ico">💄</div>
        <div class="cstrip-lbl">Beauty</div>
    </a>
    <a href="#" class="cstrip-item">
        <div class="cstrip-ico">📚</div>
        <div class="cstrip-lbl">Stationery</div>
    </a>
    <a href="#" class="cstrip-item">
        <div class="cstrip-ico">🎁</div>
        <div class="cstrip-lbl">Gifts</div>
    </a>
    <a href="#" class="cstrip-item">
        <div class="cstrip-ico">💍</div>
        <div class="cstrip-lbl">Accessories</div>
    </a>
    <a href="#" class="cstrip-item">
        <div class="cstrip-ico">🧴</div>
        <div class="cstrip-lbl">Skin Care</div>
    </a>
</section>



{{-- ============================================================
     CATEGORIES SECTION
============================================================ --}}
<section class="categories-section" id="categories">
    <div class="section-heading">
        <div class="dec">
            <h2>Shop by Categories</h2>
        </div>
        <p>Choose your favourite category</p>
    </div>

    @if ($categories->isNotEmpty())
    <div class="cat-grid">
        @foreach ($categories as $category)
        <a href="#" class="cat-card">
            <div class="cat-img-wrap">
                @if ($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                @else
                    <div class="cat-no-img">🛍️</div>
                @endif
                <div class="cat-emoji-badge">
                    @php
                        $emojis = [
                            'fancy'       => '✨',
                            'beauty'      => '💄',
                            'stationery'  => '📚',
                            'gifts'       => '🎁',
                            'accessories' => '💍',
                            'skin'        => '🧴',
                            'clothing'    => '👗',
                            'toys'        => '🧸',
                            'food'        => '🍫',
                        ];
                        $key   = strtolower($category->name);
                        $emoji = '🛍️';
                        foreach ($emojis as $word => $e) {
                            if (str_contains($key, $word)) { $emoji = $e; break; }
                        }
                    @endphp
                    {{ $emoji }}
                </div>
            </div>
            <div class="cat-body">
                <div class="cat-name">{{ $category->name }}</div>
                <span class="btn-explore">Explore</span>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <div class="empty-state">
        <div class="empty-ico">📦</div>
        <p>No categories added yet.</p>
    </div>
    @endif
</section>


{{-- ============================================================
     PRODUCTS SECTION
============================================================ --}}
<section class="products-section" id="products">
    <div class="section-heading">
        <div class="dec">
            <h2>Our Products</h2>
        </div>
        <p>Explore our wide range of fancy items</p>
    </div>

    @if ($products->isNotEmpty())
    <div class="prod-grid">
        @foreach ($products as $product)
        <div class="prod-card">
            <div class="prod-img-wrap">
                @if ($product->product_image)
                    <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->productname }}">
                @else
                    <div class="no-img">📦</div>
                @endif
            </div>
           <div class="prod-body">

    <div class="prod-name">{{ $product->productname }}</div>

    <div class="prod-price">
        ₹{{ number_format($product->selling_price) }}
    </div>

    <div class="d-grid gap-2">

        {{-- Add To Cart --}}
        <form action="{{ route('cart.store') }}" method="POST">
            @csrf

            <input type="hidden"
                   name="product_id"
                   value="{{ $product->id }}">

                     <button
                      
                        type="button"
                        class="btn-cart addCart"
                        data-id="{{ $product->id }}">
                        <i class="bi bi-cart-plus"></i>
                        Add To Cart
                    </button>

        </form>

        {{-- Order Now --}}
        <button class="btn-order-now"
            data-bs-toggle="modal"
            data-bs-target="#orderModal"
            data-id="{{ $product->id }}"
            data-name="{{ $product->productname }}"
            data-price="{{ $product->selling_price }}"
            data-image="{{ $product->product_image ? asset('storage/'.$product->product_image) : '' }}">
            🛒 Order Now
        </button>

    </div>

</div>
        </div>
        @endforeach
    </div>
    @else
    <div class="prod-grid">
        <div class="empty-state">
            <div class="empty-ico">🛍️</div>
            <p>No products available yet.</p>
        </div>
    </div>
    @endif
</section>

{{-- ============================================================
     ORDER MODAL
============================================================ --}}
<div class="modal fade order-modal" id="orderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">🛒 Place Your Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{route('orders.store')}}" method="POST">
                @csrf
                <input type="hidden" name="product_id"    id="m_product_id">
                <input type="hidden" name="product_name"  id="m_product_name">
                <input type="hidden" name="product_price" id="m_product_price">

                <div class="modal-body">

                    {{-- Product preview --}}
                    <div class="order-preview">
                        <div id="m_img_wrap">
                            <div class="no-img-sm">📦</div>
                        </div>
                        <div>
                            <div class="op-name"  id="m_display_name">—</div>
                            <div class="op-price" id="m_display_price">₹0</div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Your Name *</label>
                            <input type="text" name="customer_name" class="form-control"
                                   placeholder="Enter your full name" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" name="customer_phone" class="form-control"
                                   placeholder="+91 XXXXX XXXXX" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="customer_email" class="form-control"
                                   placeholder="your@email.com">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Quantity *</label>
                            <input type="number" name="quantity" id="m_qty"
                                   class="form-control" value="1" min="1" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Total Amount</label>
                            <input type="text" id="m_total" class="form-control" readonly
                                   style="background:#f5f5f0;font-weight:700;color:var(--green);">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Delivery Address *</label>
                            <textarea name="address" class="form-control" rows="3"
                                      placeholder="Door no, Street, City, Pincode" required></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Note (optional)</label>
                            <input type="text" name="note" class="form-control"
                                   placeholder="Any special instructions?">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-confirm-order">
                        <i class="bi bi-check-circle-fill"></i> Confirm Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Success toast --}}
@if (session('order_success'))
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index:9999;">
    <div id="orderToast" class="toast show align-items-center text-white border-0"
         style="background:#013e37;" role="alert">
        <div class="d-flex">
            <div class="toast-body fw-semibold">✅ {{ session('order_success') }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
@endif

@push('scripts')

<script>

$(document).ready(function(){

    // ===============================
    // ADD TO CART AJAX
    // ===============================
    $(document).on('click','.addCart',function(e){

        e.preventDefault();

        let button = $(this);
        let product_id = button.data('id');

        button.prop('disabled', true);

        $.ajax({

            url: "{{ route('cart.store') }}",
            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                product_id: product_id
            },

            success: function(res){

                if(res.success){

                    Swal.fire({
                        icon:'success',
                        title:'Added to Cart',
                        text:'Product added successfully.',
                        timer:1200,
                        showConfirmButton:false
                    });

                    $('#cartCount').text(res.cartCount);

                }

            },

            error:function(xhr){

                console.log(xhr.responseText);

                Swal.fire({
                    icon:'error',
                    title:'Oops...',
                    text:'Something went wrong.'
                });

            },

            complete:function(){

                button.prop('disabled', false);

            }

        });

    });



    // ===============================
    // ORDER MODAL
    // ===============================
    $(document).on('click','.btn-order-now',function(){

        const name  = $(this).data('name');
        const price = parseFloat($(this).data('price'));
        const img   = $(this).data('image');

        $('#m_product_id').val($(this).data('id'));
        $('#m_product_name').val(name);
        $('#m_product_price').val(price);

        $('#m_display_name').text(name);
        $('#m_display_price').text('₹'+price.toLocaleString('en-IN'));

        $('#m_qty').val(1);
        $('#m_total').val('₹'+price.toLocaleString('en-IN'));

        if(img){

            $('#m_img_wrap').html(
                `<img src="${img}" style="width:58px;height:58px;border-radius:8px;object-fit:cover;">`
            );

        }else{

            $('#m_img_wrap').html(
                `<div class="no-img-sm">📦</div>`
            );

        }

    });



    // ===============================
    // QUANTITY CHANGE
    // ===============================
    $(document).on('input','#m_qty',function(){

        let price = parseFloat($('#m_product_price').val()) || 0;

        let qty = parseInt($(this).val()) || 1;

        let total = price * qty;

        $('#m_total').val('₹'+total.toLocaleString('en-IN'));

    });



    // ===============================
    // AUTO HIDE TOAST
    // ===============================
    setTimeout(function(){

        $('#orderToast').removeClass('show');

    },4000);

});

</script>

@endpush
    

@endsection