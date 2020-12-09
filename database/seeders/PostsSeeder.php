<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr_title = [
          'Practical Text Classification With Python and Keras',
          'Speed Up Python With Concurrency',
          'PyQt Layouts: Create Professional-Looking GUI Applications',
          "Real Python's Office Hours: Learn With Python Experts in Real Time",
        ];
        $arr_post = [
          '<div>Imagine you could know the mood of the people on the Internet. Maybe you are not interested in its entirety, but only if people are today happy on your favorite social media platform. After this tutorial, you’ll be equipped to do this. While doing this, you will get a grasp of current advancements of (<em>deep</em>) neural networks and how they can be applied to text.<br><br></div><div>Reading the mood from text with machine learning is called <a href="#">sentiment analysis</a>, and it is one of the prominent use cases in text classification. This falls into the very active research field of <a href="#"><strong>natural language processing (NLP)</strong></a><strong>.</strong> Other common use cases of text classification include detection of spam, auto tagging of customer queries, and categorization of text into defined topics. <strong><em>So how can you do this?</em></strong><br><br></div>',
          '<div>The <strong>vocabulary</strong> in this case is a list of words that occurred in our text where each word has its own index. This enables you to create a vector for a sentence. You would then take the sentence you want to vectorize, and you count each occurrence in the vocabulary. The resulting vector will be with the length of the vocabulary and a count for each word in the vocabulary.<br><br></div><div>The resulting vector is also called a <strong>feature vector</strong>. In a feature vector, each dimension can be a numeric or categorical feature, like for example the height of a building, the price of a stock, or, in our case, the count of a word in a vocabulary. <em>These feature vectors are a crucial piece in data science and machine learning, as the model you want to train depends on them.</em><br><br></div>',
          '<div>When you work with machine learning, one important step is to define a baseline model. This usually involves a simple model, which is then used as a comparison with the more advanced models that you want to test. In this case, you’ll use the baseline model to compare it to the more advanced methods involving (deep) neural networks, the meat and potatoes of this tutorial.<br><br></div><div>First, you are going to <a href="#">split the data into a training and testing set</a> which will allow you to evaluate the accuracy and see if your model generalizes well. This means whether the model is able to perform well on data it has not seen before. This is a way to see if the model is overfitting.<br><br></div><div><strong>Overfitting</strong> is when a model is trained too well on the training data. You want to avoid overfitting, as this would mean that the model mostly just memorized the training data. This would account for a large accuracy with the training data but a low accuracy in the testing data.<br><br></div>',
          '<div>You can see that the resulting feature vectors have 750 samples which are the number of training samples we have after the train-test split. Each sample has 1714 dimensions which is the size of the vocabulary. Also, you can see that we get a <a href="#">sparse matrix</a>. This is a data type that is optimized for matrices with only a few non-zero elements, which only keeps track of the non-zero elements reducing the memory load.<br><br></div><div>CountVectorizer performs <a href="#">tokenization</a> which separates the sentences into a set of <strong>tokens</strong> as you saw previously in the vocabulary. It additionally removes punctuation and special characters and can apply other preprocessing to each word. If you want, you can use a custom tokenizer from the <a href="#">NLTK</a> library with the CountVectorizer or use any number of the customizations which you can explore to improve the performance of your model.<br><br></div>',
        ];
        for($i=1; $i<=10; $i++){
            DB::table('posts')->insert([
                'categories_id'   =>  rand(1,7),
                'title'           =>  $arr_title[rand(0,3)],
                'contents'        =>  $arr_post[rand(0,3)],
                'count_view'      =>  rand(1,100),
                'created_by'      =>  rand(1,10),
                'image'           =>  url('/').'/assets/img/post-single-'.$i.'.jpg',
                'image_resize'    =>  url('/').'/assets/img/post-'.rand(1,7).'.jpg',
            ]);
        }
    }
}
