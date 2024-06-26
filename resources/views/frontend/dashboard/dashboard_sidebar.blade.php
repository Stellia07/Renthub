<div class="widget-content">
    <ul class="category-list ">


        <li class="current"> <a href="{{ route('user.profile') }}"><i class="fa fa-user" aria-hidden="true"></i> User Profile</a></li>
        <li><a href="{{ route('user.schedule.request') }}"><i class="fa fa-calendar" aria-hidden="true"></i> Schedule Request<span class="badge badge-info">( )</span></a></li>
        <li><a href="{{ route('user.compare') }}"><i class="fa fa-list-alt" aria-hidden="true"></i></i> Compare Properties </a></li>
        <li><a href="{{ route('user.wishlist') }}"><i class="fa fa-star" aria-hidden="true"></i> Wishlist  </a></li>
        <li><a href="{{ route('live.chat') }}"><i class="fa fa-envelope" aria-hidden="true"></i> Live Chat
            @php
                $unreadCount = app(\App\Http\Controllers\Backend\ChatController::class)->getUnreadMessageCount();
            @endphp
            @if ($unreadCount > 0)
                <span class="badge badge-info">{{ $unreadCount }}</span>
            @endif
        </a></li>
        @if(Auth::check() && Auth::user()->role == 'tenant')
        <li><a href="{{ route('pay') }}"><i class="fa fa-credit-card" aria-hidden="true"></i> Payment </a></li>
        <li><a href="{{ route('view-payment-logs') }}"><i class="fa fa-file-invoice-dollar" aria-hidden="true"></i> Payment Logs </a></li>
        <li><a href="{{ route('utilities.billing') }}"><i class="fa fa-bolt" aria-hidden="true"></i> Utilities /Bills </a></li>
        <li><a href="{{ route('tenant.contract') }}"><i class="fa fa-file-contract" aria-hidden="true"></i> Contract </a></li>
        @endif
        <li><a href="{{ route('user.change.password') }}"><i class="fa fa-key" aria-hidden="true"></i> Change Password </a></li>
        <li><a href="{{ route('user.logout') }}"><i class="fa fa-chevron-circle-up" aria-hidden="true"></i> Logout </a></li>
    </ul>
</div>
