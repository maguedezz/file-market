<section class="hero is-primary">
    <div class="hero-body">
        <div class="level is-mobile">
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Total Files</p>
                    <p class="title">{{ $fileCount }}</p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Total Sales</p>
                    <p class="title">{{ $saleCount }}</p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Commission this month</p>
                    <p class="title">${{ $thisMonthCommission }}</p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Lifetime commission</p>
                    <p class="title">${{ $lifetimeCommission }}</p>
                </div>
            </div>
        </div>
    </div>
</section>