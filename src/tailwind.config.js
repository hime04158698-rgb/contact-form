export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js",

    // ★これを追加（paginationのbladeをTailwindが見に行く）
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
