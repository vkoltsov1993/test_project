<h1>Price was changed</h1>
<p>
    Dear {{ $user->name }}, <br>
    Your product {{ $productUrl->name }} price had changed.
    Previous price: <span style="color: red; font-weight: bold">{{ $productUrl->price }}</span>
    changed to <span style="color: green; font-weight: bold">{{ $newPrice }}</span>
</p>
