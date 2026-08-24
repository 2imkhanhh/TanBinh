<?php
$s = App\Models\Setting::where('key', 'home_intro_desc')->first();
$s->setTranslation('value', 'vi', 'Trong suốt quá trình hình thành và phát triển, chúng tôi hướng đến mục tiêu không chỉ là một thương hiệu chè, mà còn là cầu nối đưa hương vị Việt Nam vươn xa ra thế giới. Từng búp chè nhỏ bé mang theo khát vọng lớn, để bạn bè quốc tế biết đến, yêu mến và trân trọng những giá trị mộc mạc nhưng đầy tự hào của dân tộc Việt Nam.');
$s->save();
echo "Done\n";
