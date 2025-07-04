<!DOCTYPE html>
<html lang = "en">

<head>
  <title>Admin Page</title>
  <meta charset = "UTF-8"/>
  <link rel="stylesheet" href="{{ url('/css/Users_Info_Page.css') }}" />
  <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

<header>
  <div class = "blue_panel">
    <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Go to main page"></a>
  </div>
</header>

<main>
  <div class="search_part">

      <form method="GET" action="{{ route('admin-users') }}" style="display: flex;">
          <input type="text" name="search" placeholder="Search Users..." class="searcher" value="{{ request('search') }}">
          <button type="submit" class="search_btn">&#128269;</button>
      </form>

  </div>


  <div class = "users_table">
    <div class = "user_info header">
      <span>ID</span>

      <span>Full Name</span>

      <span>Email</span>

      <span>Role</span>
    </div>

    @if ($users->count() > 0)
        @foreach ($users as $user)
            <div class="user_info">
                <span><strong class="mobile-label">ID:</strong> {{ $user->id }}</span>

                <span><strong class="mobile-label">Full Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</span>

                <span><strong class="mobile-label">Email:</strong> {{ $user->email }}</span>

                <span>
                    <strong class="mobile-label">Role:</strong>
                    <select class="role_select" data-user-id="{{ $user->id }}">
                        <option value="admin" {{ $user->admin ? 'selected' : '' }}>Admin</option>
                        <option value="member" {{ !$user->admin ? 'selected' : '' }}>Member</option>
                    </select>
                </span>
            </div>
        @endforeach
    @else
        <div class="no_results">Sorry, no results :(</div>
    @endif

    @if ($users->lastPage() > 1)
        <div class="paging_part">

            @for ($i = 1; $i <= $users->lastPage(); $i++)
                <a href="{{ $users->url($i) }}" class="page_circle {{ $i == $users->currentPage() ? 'active' : '' }}">
                    {{ $i }}
                </a>
            @endfor

        </div>
    @endif

  </div>
</main>

<footer>
  <div class = "bottom_panel">
    <div class = "logo_part">
      <a href="{{ route('admin-page') }}" class="logo_dungeon_goodies" title="Go to admin page"></a>
    </div>

    <div class = "information_text">
      <a href = "javascript:void(0)" onclick = "alert('Please be kind on our website :)')">Terms and conditions</a>

      <div class = "contacts">
        <a href="https://is.stuba.sk/?lang=sk" target="_blank" rel="noopener noreferrer">Contact Us</a>
        <p>xpetrikj@stuba.sk</p>
        <p>xmizeraks@stuba.sk</p>
      </div>

      <a href = "https://github.com/jakub-petrik/Dungeon-Goodies" target = "_blank" rel = "noopener noreferrer">Our GitHub</a>
    </div>
  </div>
</footer>

<script src="{{ asset('js/Users_Info_Page.js') }}"></script>

</body>
</html>
