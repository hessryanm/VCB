//
//  DetailViewController.h
//  VirtualCallBoard
//
//  Created by Ryan Hess on 4/19/13.
//  Copyright (c) 2013 Ryan Hess. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface DetailViewController : UIViewController <UISplitViewControllerDelegate>

@property (strong, nonatomic) id detailItem;

@property (weak, nonatomic) IBOutlet UILabel *detailDescriptionLabel;
@end
