
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>to_do</title>
    <link rel="stylesheet" href="main.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
</head>
<body data-bs-theme="dark">
    <div class="header">
    <header>
        <img src="img/logo.png" alt="">
        <h1>Hey it's your daily planner</h1>
    </header>

    <nav>
        <ul>
            <li><a class="abt" href="#middle">About</a></li>
            <li><a class="abt" href="#foot">Contact</a></li>
            <li><a class="abt" href="todo.php">Todo</a></li>
            <li><a class="abt" href="login.php">login</a></li> 
            <li><a class="abt" href="register.php">Signup</a></li>

        </ul>
    </nav>
</div>  
<section class="hidden">
<div id="middle">
<div class="pa2">
    <div class="pa1">
        <P class="p1">The fastest way to get </p>  <p class="p2">tasks out of your head.</P><br>
        <P class="p3">Type just about anything into the task field and <br> Todoist’s one-of-its-kind natural language  <br>recognition will instantly fill your to-do list.</P>
    </div>
    <img src="img/10.png" alt="" class="i1">
</div>
</section>
    <p class="p4">“Todoist makes it easy to go as <br>simple or as complex as you want”</p>
<section class="hidden" >
<div class="pa2">
    <img src="img/6.png" alt="" class="i2">
    
    <p class="p5">A task manager you <br>can trust for life</p>
</div>
</section>
<section class="hidden" >
<div class="pa3">
    <p class="p21">
    you can also  find a list of tasks with their <br>corresponding completion dates, giving you a <br>clear timeline of your productivity. Whether<br> you're managing  personal projects, work <br> assignments, or any other type of tasks,<br> this overview can be a valuable tool to <br> assess your efficiency and  manage your <br>time effectively.
    </p>
    <img class="i9" src="img/7.png" alt="" >
</div>
</section>

<section class="hidden" >
<div class="pa4">
    <img class="i10" src="img/8.png" alt="">
    <p class="p22">We understand the importance of safeguarding <br> your tasks and data, and that's why we've<br> implemented a robust login system. <br>This system ensures that only authorized users <br>can access their task lists and related <br>information. Your privacy and security are<br> our top priorities.
</div>
</section>

<section class="hidden" >
<div class="pa3">
    <p class="p23">
    "Edit Your Task" streamlines and simplifies task management, making it effortless to modify and organize your to-do list.
    </p>
    <img class="i13" src="img/12.png" alt="" >
</div>
</section>

<section class="hidden" >
<div class="pa4">
    <img class="i10" src="img/15.png" alt="">
    <p class="p24">Too many tasks! <br> Just search tasks that you need 
</p>
</section>

<section class="hidden" >
</div>
</div>
<div class="foot" id="foot">
<p class="p6">Join millions of people who organize <br> work and life with Todoist.</p>
<div class="connect">
<p class="p7">Connect us with :-</p>
<a href="https://twitter.com/Atharv_maske_?t=1JPYOkP_JsNNs9Mw3R0Rhg&s=08">
<img src="img/Twitter-new-logo.jpeg" alt="" class="i3">
</a>
<a href="https://www.linkedin.com/in/atharv-maske-61a983257">
<img src="img/LinkedIn_logo_initials.png.webp" alt="" class="i4">
</a>
<img src="img/Gmail_icon_(2020).svg.webp" alt="" class="i5">
<p class="p9">maskeatharv03@gmail.com , dalavisarang@gmail.com</p>
</div>
</section>
<script>

    const observer = new IntersectionObserver((entries) =>{
        entries.forEach((entry) =>{
            console.log(entry)
            if(entry.isIntersecting){
                entry.target.classList.add('show');
            }else{
                entry.target.classList.remove('show');
            }
        });
    });

    const hiddenElements = document.querySelectorAll('.hidden');
    hiddenElements.forEach((el) => observer.observe(el));
</script>

</body>
</html>
