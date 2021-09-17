<?php

if (!function_exists('letters')) {
    /**
     * @param $text
     *
     * @return mixed
     */
    function letters($text)
    {
        $from = $to = array();
        $from[] = array(
            '؆', '؇', '؈', '؉', '؊', '؍', '؎', 'ؐ', 'ؑ', 'ؒ', 'ؓ', 'ؔ', 'ؕ',
            'ؖ', 'ؘ', 'ؙ', 'ؚ', '؞', 'ٖ', 'ٗ', '٘', 'ٙ', 'ٚ', 'ٛ', 'ٜ', 'ٝ', 'ٞ', 'ٟ', '٪',
            '٬', '٭', 'ہ', 'ۂ', 'ۃ', '۔', 'ۖ', 'ۗ', 'ۘ', 'ۙ', 'ۚ', 'ۛ', 'ۜ', '۞', '۟', '۠',
            'ۡ', 'ۢ', 'ۣ', 'ۤ', 'ۥ', 'ۦ', 'ۧ', 'ۨ', '۩', '۪', '۫', '۬', 'ۭ', 'ۮ', 'ۯ', 'ﮧ',
            '﮲', '﮳', '﮴', '﮵', '﮶', '﮷', '﮸', '﮹', '﮺', '﮻', '﮼', '﮽', '﮾', '﮿', '﯀', '﯁', 'ﱞ',
            'ﱟ', 'ﱠ', 'ﱡ', 'ﱢ', 'ﱣ', 'ﹰ', 'ﹱ', 'ﹲ', 'ﹳ', 'ﹴ', 'ﹶ', 'ﹷ', 'ﹸ', 'ﹹ', 'ﹺ', 'ﹻ', 'ﹼ', 'ﹽ',
            'ﹾ', 'ﹿ',
        );
        $to[] = '';
        $from[] = array(
            'أ', 'إ', 'ٱ', 'ٲ', 'ٳ', 'ٵ', 'ݳ', 'ݴ', 'ﭐ', 'ﭑ', 'ﺃ', 'ﺄ', 'ﺇ', 'ﺈ',
            'ﺍ', 'ﺎ', '𞺀', 'ﴼ', 'ﴽ', '𞸀',
        );
        $to[] = 'ا';
        $from[] = array(
            'ٮ', 'ݕ', 'ݖ', 'ﭒ', 'ﭓ', 'ﭔ', 'ﭕ', 'ﺏ', 'ﺐ', 'ﺑ', 'ﺒ', '𞸁', '𞸜',
            '𞸡', '𞹡', '𞹼', '𞺁', '𞺡',
        );
        $to[] = 'ب';
        $from[] = array('ڀ', 'ݐ', 'ݔ', 'ﭖ', 'ﭗ', 'ﭘ', 'ﭙ', 'ﭚ', 'ﭛ', 'ﭜ', 'ﭝ');
        $to[] = 'پ';
        $from[] = array(
            'ٹ', 'ٺ', 'ٻ', 'ټ', 'ݓ', 'ﭞ', 'ﭟ', 'ﭠ', 'ﭡ', 'ﭢ', 'ﭣ', 'ﭤ', 'ﭥ',
            'ﭦ', 'ﭧ', 'ﭨ', 'ﭩ', 'ﺕ', 'ﺖ', 'ﺗ', 'ﺘ', '𞸕', '𞸵', '𞹵', '𞺕', '𞺵',
        );
        $to[] = 'ت';
        $from[] = array('ٽ', 'ٿ', 'ݑ', 'ﺙ', 'ﺚ', 'ﺛ', 'ﺜ', '𞸖', '𞸶', '𞹶', '𞺖', '𞺶');
        $to[] = 'ث';
        $from[] = array(
            'ڃ', 'ڄ', 'ﭲ', 'ﭳ', 'ﭴ', 'ﭵ', 'ﭶ', 'ﭷ', 'ﭸ', 'ﭹ', 'ﺝ', 'ﺞ', 'ﺟ',
            'ﺠ', '𞸂', '𞸢', '𞹂', '𞹢', '𞺂', '𞺢',
        );
        $to[] = 'ج';
        $from[] = array(
            'ڇ', 'ڿ', 'ݘ', 'ﭺ', 'ﭻ', 'ﭼ', 'ﭽ', 'ﭾ', 'ﭿ', 'ﮀ', 'ﮁ',
            '𞸃', '𞺃',
        );
        $to[] = 'چ';
        $from[] = array(
            'ځ', 'ݮ', 'ݯ', 'ݲ', 'ݼ', 'ﺡ', 'ﺢ', 'ﺣ', 'ﺤ', '𞸇', '𞸧', '𞹇', '𞹧',
            '𞺇', '𞺧',
        );
        $to[] = 'ح';
        $from[] = array('ڂ', 'څ', 'ݗ', 'ﺥ', 'ﺦ', 'ﺧ', 'ﺨ', '𞸗', '𞸷', '𞹗', '𞹷', '𞺗', '𞺷');
        $to[] = 'خ';
        $from[] = array(
            'ڈ', 'ډ', 'ڊ', 'ڌ', 'ڍ', 'ڎ', 'ڏ', 'ڐ', 'ݙ', 'ݚ', 'ﺩ', 'ﺪ', '𞺣', 'ﮂ',
            'ﮃ', 'ﮈ', 'ﮉ',
        );
        $to[] = 'د';
        $from[] = array('ﱛ', 'ﱝ', 'ﺫ', 'ﺬ', '𞸘', '𞺘', '𞺸', 'ﮄ', 'ﮅ', 'ﮆ', 'ﮇ');
        $to[] = 'ذ';
        $from[] = array(
            '٫', 'ڑ', 'ڒ', 'ړ', 'ڔ', 'ڕ', 'ږ', 'ݛ', 'ݬ', 'ﮌ', 'ﮍ', 'ﱜ', 'ﺭ', 'ﺮ',
            '𞸓', '𞺓', '𞺳',
        );
        $to[] = 'ر';
        $from[] = array('ڗ', 'ڙ', 'ݫ', 'ݱ', 'ﺯ', 'ﺰ', '𞸆', '𞺆', '𞺦');
        $to[] = 'ز';
        $from[] = array('ﮊ', 'ﮋ', 'ژ');
        $to[] = 'ژ';
        $from[] = array('ښ', 'ݽ', 'ݾ', 'ﺱ', 'ﺲ', 'ﺳ', 'ﺴ', '𞸎', '𞸮', '𞹎', '𞹮', '𞺎', '𞺮');
        $to[] = 'س';
        $from[] = array(
            'ڛ', 'ۺ', 'ݜ', 'ݭ', 'ݰ', 'ﺵ', 'ﺶ', 'ﺷ', 'ﺸ', '𞸔', '𞸴', '𞹔', '𞹴',
            '𞺔', '𞺴',
        );
        $to[] = 'ش';
        $from[] = array('ڝ', 'ﺹ', 'ﺺ', 'ﺻ', 'ﺼ', '𞸑', '𞹑', '𞸱', '𞹱', '𞺑', '𞺱');
        $to[] = 'ص';
        $from[] = array('ڞ', 'ۻ', 'ﺽ', 'ﺾ', 'ﺿ', 'ﻀ', '𞸙', '𞸹', '𞹙', '𞹹', '𞺙', '𞺹');
        $to[] = 'ض';
        $from[] = array('ﻁ', 'ﻂ', 'ﻃ', 'ﻄ', '𞸈', '𞹨', '𞺈', '𞺨');
        $to[] = 'ط';
        $from[] = array('ڟ', 'ﻅ', 'ﻆ', 'ﻇ', 'ﻈ', '𞸚', '𞹺', '𞺚', '𞺺');
        $to[] = 'ظ';
        $from[] = array('؏', 'ڠ', 'ﻉ', 'ﻊ', 'ﻋ', 'ﻌ', '𞸏', '𞸯', '𞹏', '𞹯', '𞺏', '𞺯');
        $to[] = 'ع';
        $from[] = array(
            'ۼ', 'ݝ', 'ݞ', 'ݟ', 'ﻍ', 'ﻎ', 'ﻏ', 'ﻐ', '𞸛', '𞸻', '𞹛', '𞹻', '𞺛',
            '𞺻',
        );
        $to[] = 'غ';
        $from[] = array(
            '؋', 'ڡ', 'ڢ', 'ڣ', 'ڤ', 'ڥ', 'ڦ', 'ݠ', 'ݡ', 'ﭪ', 'ﭫ', 'ﭬ', 'ﭭ',
            'ﭮ', 'ﭯ', 'ﭰ', 'ﭱ', 'ﻑ', 'ﻒ', 'ﻓ', 'ﻔ', '𞸐', '𞸞', '𞸰', '𞹰', '𞹾', '𞺐', '𞺰',
        );
        $to[] = 'ف';
        $from[] = array(
            'ٯ', 'ڧ', 'ڨ', 'ﻕ', 'ﻖ', 'ﻗ', 'ﻘ', '𞸒', '𞸟', '𞸲', '𞹒', '𞹟', '𞹲',
            '𞺒', '𞺲', '؈',
        );
        $to[] = 'ق';
        $from[] = array(
            'ػ', 'ؼ', 'ك', 'ڪ', 'ګ', 'ڬ', 'ڭ', 'ڮ', 'ݢ', 'ݣ', 'ݤ', 'ݿ', 'ﮎ',
            'ﮏ', 'ﮐ', 'ﮑ', 'ﯓ', 'ﯔ', 'ﯕ', 'ﯖ', 'ﻙ', 'ﻚ', 'ﻛ', 'ﻜ', '𞸊', '𞸪', '𞹪',
        );
        $to[] = 'ک';
        $from[] = array(
            'ڰ', 'ڱ', 'ڲ', 'ڳ', 'ڴ', 'ﮒ', 'ﮓ', 'ﮔ', 'ﮕ', 'ﮖ', 'ﮗ', 'ﮘ', 'ﮙ', 'ﮚ',
            'ﮛ', 'ﮜ', 'ﮝ',
        );
        $to[] = 'گ';
        $from[] = array(
            'ڵ', 'ڶ', 'ڷ', 'ڸ', 'ݪ', 'ﻝ', 'ﻞ', 'ﻟ', 'ﻠ', '𞸋', '𞸫', '𞹋', '𞺋',
            '𞺫',
        );
        $to[] = 'ل';
        $from[] = array('۾', 'ݥ', 'ݦ', 'ﻡ', 'ﻢ', 'ﻣ', 'ﻤ', '𞸌', '𞸬', '𞹬', '𞺌', '𞺬');
        $to[] = 'م';
        $from[] = array(
            'ڹ', 'ں', 'ڻ', 'ڼ', 'ڽ', 'ݧ', 'ݨ', 'ݩ', 'ﮞ', 'ﮟ', 'ﮠ', 'ﮡ', 'ﻥ', 'ﻦ',
            'ﻧ', 'ﻨ', '𞸍', '𞸝', '𞸭', '𞹍', '𞹝', '𞹭', '𞺍', '𞺭',
        );
        $to[] = 'ن';
        $from[] = array(
            'ؤ', 'ٶ', 'ٷ', 'ۄ', 'ۅ', 'ۆ', 'ۇ', 'ۈ', 'ۉ', 'ۊ', 'ۋ', 'ۏ', 'ݸ', 'ݹ',
            'ﯗ', 'ﯘ', 'ﯙ', 'ﯚ', 'ﯛ', 'ﯜ', 'ﯝ', 'ﯞ', 'ﯟ', 'ﯠ', 'ﯡ', 'ﯢ', 'ﯣ', 'ﺅ', 'ﺆ', 'ﻭ', 'ﻮ',
            '𞸅', '𞺅', '𞺥',
        );
        $to[] = 'و';
        $from[] = array(
            'ة', 'ھ', 'ۀ', 'ە', 'ۿ', 'ﮤ', 'ﮥ', 'ﮦ', 'ﮩ', 'ﮨ', 'ﮪ', 'ﮫ', 'ﮬ', 'ﮭ',
            'ﺓ', 'ﺔ', 'ﻩ', 'ﻪ', 'ﻫ', 'ﻬ', '𞸤', '𞹤', '𞺄',
        );
        $to[] = 'ه';
        $from[] = array(
            'ؠ', 'ؽ', 'ؾ', 'ؿ', 'ى', 'ي', 'ٸ', 'ۍ', 'ێ', 'ې', 'ۑ', 'ے', 'ۓ',
            'ݵ', 'ݶ', 'ݷ', 'ݺ', 'ݻ', 'ﮢ', 'ﮣ', 'ﮮ', 'ﮯ', 'ﮰ', 'ﮱ', 'ﯤ', 'ﯥ', 'ﯦ', 'ﯧ', 'ﯨ',
            'ﯩ', 'ﯼ', 'ﯽ', 'ﯾ', 'ﯿ', 'ﺉ', 'ﺊ', 'ﺋ', 'ﺌ', 'ﻯ', 'ﻰ', 'ﻱ', 'ﻲ', 'ﻳ', 'ﻴ', '𞸉', '𞸩',
            '𞹉', '𞹩', '𞺉', '𞺩',
        );
        $to[] = 'ی';
        $from[] = array('ٴ', '۽', 'ﺀ');
        $to[] = 'ء';
        $from[] = array('ﻵ', 'ﻶ', 'ﻷ', 'ﻸ', 'ﻹ', 'ﻺ', 'ﻻ', 'ﻼ');
        $to[] = 'لا';
        $from[] = array(
            'ﷲ', '﷼', 'ﷳ', 'ﷴ', 'ﷵ', 'ﷶ', 'ﷷ', 'ﷸ',
            'ﷹ', 'ﷺ', 'ﷻ',
        );
        $to[] = array(
            'الله', 'ریال', 'اکبر', 'محمد', 'صلعم', 'رسول', 'علیه', 'وسلم',
            'صلی', 'صلی الله علیه وسلم', 'جل جلاله',
        );

        for ($i = 0; $i < count($from); $i++) {
            $text = str_replace($from[$i], $to[$i], $text);
        }

        return $text;
    }
}

