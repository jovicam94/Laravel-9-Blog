<div class="col-4">
        <div class="container">
            <div class="row">
            <x-card title="Most commented" subtitle="What people are currently talking about"
                    :items="$most_commented"/>
            </div>
            <div class="row mt-4">
                <x-card title="Most Active" subtitle="Users with most posts written"
                        :items="$most_active"/>
            </div>
            <div class="row mt-4">
                <x-card title="Most Active Last Month" subtitle="Users with most posts written in the last month"
                        :items="$most_active_last_month"/>
            </div>
        </div>
    </div>
