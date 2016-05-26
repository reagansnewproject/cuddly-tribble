<?php
class QuestionsSeeder extends Seeder {
	public function run() {
		$question1 = new Question();
		$question1->question = "What is your favorite color?";
		$question1->save();

		$question2 = new Question();
		$question2->question = "What is your favorite band?";
		$question2->save();

		$question3 = new Question();
		$question3->question = "Do you have any siblings?";
		$question3->save();

		$question4 = new Question();
		$question4->question = "If you could recommend one movie for everybody to watch, what would it be? Why?";
		$question4->save();

		$question5 = new Question();
		$question5->question = "Do you have pets? What kind? What are their names?";
		$question5->save();

		$question6 = new Question();
		$question6->question = "If you were an animal, what would you be?";
		$question6->save();

		$question7 = new Question();
		$question7->question = "If a movie was made about your life, what would it be called, and who would play you?";
		$question7->save();

		$question8 = new Question();
		$question8->question = "If you could meet anybody (living or dead), who would you choose to meet? Why?";
		$question8->save();

		$question9 = new Question();
		$question9->question = "Who is your favorite author?";
		$question9->save();

		$question10 = new Question();
		$question10->question = "If you were running for president, what would your campaign slogan be?";
		$question10->save();

		$question11 = new Question();
		$question11->question = "What do you do for a living?";
		$question11->save();

		$question12 = new Question();
		$question12->question = "Describe your religious practice, if applicable?";
		$question12->save();

		$question13 = new Question();
		$question13->question = "How do you act when you're angry?";
		$question13->save();

		$question14 = new Question();
		$question14->question = "If money weren't part of the equation, what would you choose to do with your life?";
		$question14->save();

		$question15 = new Question();
		$question15->question = "What do you like to do in your free time?";
		$question15->save();

		$question16 = new Question();
		$question16->question = "Describe your personal 'style'?";
		$question16->save();

		$question17 = new Question();
		$question17->question = "You are given $50 on the condition that you must do something with it before the end of the day. What do you do with it?";
		$question17->save();	

		$question18 = new Question();
		$question18->question = "If you could do one thing with no repercussions (other than directly harming another person), what would it be?";
		$question18->save();

		$question19 = new Question();
		$question19->question = "If you could punch one human being in the face as hard as you can without fear of punishment, who would you choose to do it to?";
		$question19->save();

		$question20 = new Question();
		$question20->question = "If you could change one thing about yourself, what would it be?";
		$question20->save();

		$question21 = new Question();
		$question21->question = "What are you looking for in a relationship?";
		$question21->save();

		$question22 = new Question();
		$question22->question = "Describe your ideal man/woman?";
		$question22->save();

		$question23 = new Question();
		$question23->question = "What is the most important thing you have learned from past relationships?";
		$question23->save();

		$question24 = new Question();
		$question24->question = "What is one character flaw you have that you think people ought to know?";
		$question24->save();

		$question25 = new Question();
		$question25->question = "Why did you join Screenlight?";
		$question25->save();

		$question26 = new Question();
		$question26->question = "What do you believe made you the person you are today?";
		$question26->save();

		$question27 = new Question();
		$question27->question = "What is it that you most fear in possible relationships?";
		$question27->save();

		$question28 = new Question();
		$question28->question = "What are you most passionate about in life?";
		$question28->save();

		$question29 = new Question();
		$question29->question = "If you could end one problem in the world, what would it be?";
		$question29->save();

		$question30 = new Question();
		$question30->question = "What is one flaw in a potential partner that you would not be able to overlook? Why?";
		$question30->save();
	}
}
?>