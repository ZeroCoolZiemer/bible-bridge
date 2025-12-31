<?php
$verses = [
    "John 3:16" => "For God so loved the world, that he gave his only begotten Son, that whosoever believeth in him should not perish, but have everlasting life.",
    "Philippians 4:13" => "I can do all things through Christ which strengtheneth me.",
    "Jeremiah 29:11" => "For I know the thoughts that I think toward you, saith the Lord, thoughts of peace, and not of evil, to give you an expected end.",
    "Romans 8:28" => "And we know that all things work together for good to them that love God, to them who are the called according to his purpose.",
    "Psalm 23:1" => "The Lord is my shepherd; I shall not want.",
    "Matthew 11:28" => "Come unto me, all ye that labour and are heavy laden, and I will give you rest.",
    "Proverbs 3:5-6" => "Trust in the Lord with all thine heart; and lean not unto thine own understanding. In all thy ways acknowledge him, and he shall direct thy paths.",
    "Isaiah 41:10" => "Fear thou not; for I am with thee: be not dismayed; for I am thy God: I will strengthen thee; yea, I will help thee; yea, I will uphold thee with the right hand of my righteousness.",
    "Romans 12:2" => "And be not conformed to this world: but be ye transformed by the renewing of your mind, that ye may prove what is that good, and acceptable, and perfect, will of God.",
    "Matthew 5:14-16" => "Ye are the light of the world. A city that is set on a hill cannot be hid. Neither do men light a candle, and put it under a bushel, but on a candlestick, and it giveth light unto all that are in the house. Let your light so shine before men, that they may see your good works, and glorify your Father which is in heaven.",
    "Romans 10:9" => "That if thou shalt confess with thy mouth the Lord Jesus, and shalt believe in thine heart that God hath raised him from the dead, thou shalt be saved.",
    "Psalm 46:1" => "God is our refuge and strength, a very present help in trouble.",
    "Isaiah 40:31" => "But they that wait upon the Lord shall renew their strength; they shall mount up with wings as eagles; they shall run, and not be weary; and they shall walk, and not faint.",
    "2 Corinthians 5:17" => "Therefore if any man be in Christ, he is a new creature: old things are passed away; behold, all things are become new.",
    "James 1:5" => "If any of you lack wisdom, let him ask of God, that giveth to all men liberally, and upbraideth not; and it shall be given him.",
    "Psalm 34:8" => "O taste and see that the Lord is good: blessed is the man that trusteth in him.",
    "Joshua 1:9" => "Have not I commanded thee? Be strong and of a good courage; be not afraid, neither be thou dismayed: for the Lord thy God is with thee whithersoever thou goest.",
    "Romans 3:23" => "For all have sinned, and come short of the glory of God;",
    "2 Timothy 1:7" => "For God hath not given us the spirit of fear; but of power, and of love, and of a sound mind.",
    "Hebrews 11:1" => "Now faith is the substance of things hoped for, the evidence of things not seen.",
    "1 Corinthians 13:4-7" => "Love is patient, love is kind. It does not envy, it does not boast, it is not proud. It does not dishonor others, it is not self-seeking, it is not easily angered, it keeps no record of wrongs. Love does not delight in evil but rejoices with the truth. It always protects, always trusts, always hopes, always perseveres.",
    "Matthew 28:18-20" => "And Jesus came and spake unto them, saying, All power is given unto me in heaven and in earth. Go ye therefore, and teach all nations, baptizing them in the name of the Father, and of the Son, and of the Holy Ghost: Teaching them to observe all things whatsoever I have commanded you: and, lo, I am with you alway, even unto the end of the world. Amen.",
    "1 Peter 5:7" => "Casting all your care upon him; for he careth for you.",
    "Galatians 5:22-23" => "But the fruit of the Spirit is love, joy, peace, longsuffering, gentleness, goodness, faith, meekness, temperance: against such there is no law.",
    "Ephesians 2:8-9" => "For by grace are ye saved through faith; and that not of yourselves: it is the gift of God: Not of works, lest any man should boast.",
    "Titus 2:11-12" => "For the grace of God that bringeth salvation hath appeared to all men, Teaching us that, denying ungodliness and worldly lusts, we should live soberly, righteously, and godly, in this present world;",
    "1 John 4:19" => "We love him, because he first loved us.",
    "John 14:6" => "Jesus saith unto him, I am the way, the truth, and the life: no man cometh unto the Father, but by me.",
    "2 Peter 3:9" => "The Lord is not slack concerning his promise, as some men count slackness; but is longsuffering to us-ward, not willing that any should perish, but that all should come to repentance.",
    "Romans 5:8" => "But God commendeth his love toward us, in that, while we were yet sinners, Christ died for us.",
    "Hebrews 13:8" => "Jesus Christ the same yesterday, and today, and forever."
];

$smarty->assign('bibleVerses', $verses);

$random_verse = array_rand($verses);
$smarty->assign('randomVerse', [
    'reference' => $random_verse,
    'text' => $verses[$random_verse]
]);
?>