<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Chirper Home Page</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-r from-blue-300 via-cyan-500 to-blue-800">
    <div class="flex justify-center mt-4">
        <h1 class=" text-3xl md:text-7xl text-white">
            <a href="{{ route('login') }}">
                <img src="{{ asset('images/Twitter.webp') }}" alt="logo" class="inline h-10 w-10 md:h-20 md:w-20 object-contain rounded-md mx-auto hover:scale-125"/>
            </a>
            Welcome To Chirper
            <a href="{{ route('login') }}">
                <img src="{{ asset('images/Twitter.webp') }}" alt="logo" class="inline h-10 w-10 md:h-20 md:w-20 object-contain rounded-md mx-auto hover:scale-125"/>
            </a>
        </h1>
    </div>
    <div class="flex mt-2 justify-around text-white">
        <h2 class="md:text-2xl">See What Your Friends Are Chirping About!</h2>
    </div>
    <div class="md:flex m-5 justify-center items-center">
        <div class="md:w-1/3 m-5 text-center">
            <div class="bg-white rounded inline-block p-3 shadow-lg m-2 border border-black">
                Bob &commat;bob "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Non atque, iste obcaecati fuga pariatur maiores tempore esse odit nobis sequi molestiae qui optio vel? Cum quisquam sint non ad dicta."
            </div>
            <div class="bg-white rounded inline-block p-3 shadow-lg m-2 border border-black">
                Thomas &commat;tcoates "Chirper is my favorite social media app!"
            </div>
        </div>
        <div class="md:w-1/3 m-5 text-center">
            <div class="shadow-xl rounded-lg justify-center text-white bg-blue-500 p-3 m-2 text-2xl border border-white inline-block">
                Everyone Loves Chirping
            </div>
            <div class="bg-white rounded inline-block p-3 shadow-lg m-2 border border-black">
                Kenan &commat;kpoole "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus consequuntur asperiores voluptas architecto a libero, commodi delectus quos praesentium recusandae illo, molestiae iure. Explicabo illum omnis quia quidem libero odit culpa fugit id molestias illo impedit deleniti modi, animi, nemo commodi facere! Et sunt provident dignissimos aspernatur laboriosam nulla placeat!"
            </div>
        </div>
        <div class="md:w-1/3 m-5 text-center">
            <div class="bg-white rounded inline-block p-3 shadow-lg m-2 border border-black">
                Kenan &commat;Kenan "Love it! <span class="text-amber-500 text-xl">&#9733;&#9733;&#9733;&#9733;&#9733;</span>"
            </div>
            <div class="bg-white rounded inline-block p-3 shadow-lg m-2 border border-black">
                Michael &commat;shepshep7 "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
            </div>
        </div>
    </div>
    
    
    
    
    
    
    <div class="md:flex m-10 justify-around">
        <div name="card1" class="m-2 shadow-xl hover:scale-125">
            <div name="card1-head" class="flex text-white md:text-3xl bg-blue-500 rounded rounded-b-none w-max-prose items-center">
                <div class="rounded-r-none p-5 pr-12">
                    Sparrow Tier 
                </div>
                <div class="rounded-l-none p-5 pl-12 md:text-5xl">
                    $0 
                </div>
            </div>
            <div class="card1-body bg-white rounded rounded-t-none p-5 border-2 border-blue-500">
                <ul class="text-lg">
                    <li class="flex items-center p-3">
                        <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Unlimited Chirps
                    </li>
                    <li class="flex items-center p-3">
                        <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Free
                    </li>
                    <li class="flex items-center p-3">
                        <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>    
                        See Everyone's Chirps
                    </li>
                    <li class="flex items-center p-3">
                        <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>    
                        Follow Other Chirpers
                    </li>
                    <li class="flex items-center p-3">
                        <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Chirp With Your Friends
                    </li>
                </ul>
                <div class="text-center mt-2">
                    <a href="{{ route('register') }}" class="btn bg-blue-500 text-white text-xl rounded-full p-2 px-10 hover:bg-blue-800 shadow-lg">Choose Plan</a>
                </div>
            </div>
        </div>
        
        <div name="card2" class="m-2 shadow-xl hover:scale-125">
            <div name="card2-head" class="flex text-white md:text-3xl bg-gray-400 rounded rounded-b-none w-full items-center">
                <div class="rounded-r-none p-5 pr-12">
                    Hawk Tier 
                </div>
                <div class="rounded-l-none p-5 pl-12 md:text-5xl">
                    $10 
                </div>
            </div>
            <div class="card2-body bg-white rounded rounded-t-none p-5 border-2 border-gray-400">
                <ul class="text-lg">
                    <li class="flex items-center p-3">
                        <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Unlimited Chirps
                    </li>
                    <li class="flex items-center p-3">
                        <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Give Us Money 
                    </li>
                    <li class="flex items-center p-3">
                        <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>    
                        Create Multiple Accounts
                    </li>
                    <li class="flex items-center p-3">
                        <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>    
                        See Chirpers Who Follow You
                    </li>
                    <li class="flex items-center p-3">
                        <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Limited Ads
                    </li>
                </ul>
                <div class="text-center mt-2">
                    <a href="{{ route('register') }}" class="btn bg-gray-400 text-white text-xl rounded-full p-2 px-10 hover:bg-gray-700 shadow-lg">Choose Plan</a>
                </div>
            </div>
        </div>
        
        <div name="card3" class="m-2 shadow-xl hover:scale-125">
            <div name="card3-head" class="flex text-white md:text-3xl bg-amber-500 rounded rounded-b-none w-full items-center">
                <div class="rounded-r-none p-5 pr-14">
                    Eagle Tier 
                </div>
                <div class="rounded-l-none p-5 pl-14 md:text-5xl">
                    $20 
                </div>
            </div>
            <div class="card3-body bg-white rounded rounded-t-none p-5 border-2 border-amber-500">
                <ul class="text-lg">
                    <li class="flex items-center p-3">
                        <svg class="h-5 w-5 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Unlimited Chirps
                    </li>
                    <li class="flex items-center p-3">
                        <svg class="h-5 w-5 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Give Us More Money
                    </li>
                    <li class="flex items-center p-3">
                        <svg class="h-5 w-5 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>    
                        Access Partnership Program
                    </li>
                    <li class="flex items-center p-3">
                        <svg class="h-5 w-5 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>    
                        No Spam Bots
                    </li>
                    <li class="flex items-center p-3">
                        <svg class="h-5 w-5 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        No Ads
                    </li>
                </ul>
                <div class="text-center mt-2">
                    <a href="{{ route('register') }}" class="btn bg-amber-500 text-white text-xl rounded-full p-2 px-10 hover:bg-amber-800 shadow-lg">Choose Plan</a>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="md:mt-20">
        <div class="text-center">
            <h4 class="text-white md:text-2xl">Already have an account?</h4>
            <a href="{{ route('login')}}" class="btn border border-black bg-white text-black text-lg rounded-full w-auto inline-block p-2 px-20 hover:bg-gray-300 mt-3 shadow-xl">Sign In</a>
        </div>
    </div>
    </body>
    <footer>
        <div class="text-center md:mt-20 text-gray-700">
            By signing up, you agree to the Terms of Service and Privacy Policy, including Cookie Use. &copy Chirper 
        </div>
    </footer>


</html>