<header class="masthead bg-warning text-white">
    <div class="container" style="margin-top:-30px">
    
    <div class="alert alert-danger">{{ $message ?? 'Require Admin Access' }}</div>
    {!! form_open('home/login_admin') !!}
        <center><strong>Account</strong></center>
        <div class="form-group">
        <label for="username">username</label>
        <input type="text" name="username" id="username" class="form-control" required="" placeholder="username" value="{{ $username ?? '' }}">
        </div>
        <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" value="{{ $password ?? '' }}" required="" placeholder="password">
        </div>
        <button class="btn btn-primary pull-right butto-large" type="submit">Login</button>
    {!! form_close() !!}
    </div>
</header>

<script>
            $("form").on('submit',function (e) { 
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    dataType: "html",
                    beforeSend: function(){
                        loadPage();
                    },
                    success: function (response) {
                        loadPage(response)
                    }
                }).fail(function(){
                    errorPage();
                });
                return;
            });
</script>

