<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>
<body>
    <h1>Tweetbox</h1>
    <div id="app">
    <form @submit.prevent="tweeter">
        <textarea v-model="text"></textarea>
        <p :class="{limite: limiteAtteinte}">{{ nombreRestants }}</p>
        <button :disabled="limiteAtteinte">Tweet</button>
        <input v-model ="photo" id="photo" type="checkbox">
        <label for="photo">{{ labelPhoto }}</label>
    </form>
    
    <table border="1">
            <tr>
                <th>Tweet</th>
                <th>Photo</th>
            </tr>
            <tr v-for="item in tweet">
                <td><strong>{{ item.text }}</strong></td>
                <td>{{ item.photo }}</td>
                <td v-if="photo"><img src="https://picsum.photos/200/200"></td>
            </tr>
        </table>
</div>
    <div id="tweets"></div>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="assets/Vue.js"></script>
</body>
</html>