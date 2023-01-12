<div class="col-4">
        <div class="container">
            <div class="row">
            <x-card title="{{ __('Most Commented') }}" subtitle="{{ __('What people are currently talking about') }}"
                    :items="$most_commented"/>
            </div>
            <div class="row mt-4">
                <x-card title="{{ __('Most Active') }}" subtitle="{{ __('Writers with most posts written') }}"
                        :items="$most_active"/>
            </div>
            <div class="row mt-4">
                <x-card title="{{ __('Most Active Last Month') }}" subtitle="{{ __('Users with most posts written in the month') }}"
                        :items="$most_active_last_month"/>
            </div>
        </div>
    </div>
